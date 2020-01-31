<?php
/**
 * Task Templates
 */

namespace App\Controller;

use App\Entity\Task;
use App\Entity\TaskTemplate;
use App\Entity\TaskTemplateDetail;
use App\Form\TaskTemplateDetailType;
use App\Form\TaskType;
use App\Helper\Utils;
use App\Repository\TaskTemplateRepository;
use Aws\Sqs\SqsClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskTemplateController extends BaseController {

    use Utils;

    /**
     * @Route("/tasktemplate", name="tasktemplate")
     */
    public function tasktemplate(Request $request, TaskTemplateRepository $tasktemplateRepository) {
        $tasktemplate = new TaskTemplate();
        return $this->render('tasktemplate.twig', ['tasktemplates' => $tasktemplateRepository->getAll($this->getAccountId()), "tasktemplate" => $tasktemplate->toArray(), 'form' => $this->createForm(TaskTemplateDetailType::class, new TaskTemplateDetail(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/newtasktemplate")
     */
    public function new(Request $request, TaskTemplateRepository $tasktemplateRepository) {
        $tasktemplate = new TaskTemplate();
        return $this->render('tasktemplate_form.twig', [ "tasktemplate" => $tasktemplate->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(TaskType::class, new TaskTemplate(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/tasktemplate/refresh")
     */
    public function refresh(TaskTemplateRepository $tasktemplateRepository) {
        $tasktemplate = new TaskTemplate();
        return $this->render('tasktemplate_table.twig', ['tasktemplates' => $tasktemplateRepository->getAll($this->getAccountId()), "tasktemplate" => $tasktemplate->toArray(), 'form' => $this->createForm(TaskType::class, new TaskTemplate(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/edittasktemplate", methods={"GET"})
     */
    public function edit(Request $request) {
        $tasktemplate = $this->getDoctrine()->getRepository(Task::class)->find($request->query->get("id"));

        return $this->render('tasktemplate_form.twig', ['tasktemplate'=> $tasktemplate->toArray(), 'form' => $this->createForm(TaskType::class, new TaskTemplate(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/viewtasktemplate", methods={"GET"})
     */
    public function view(Request $request, TaskTemplateRepository $tasktemplateRepository) {
        $tasktemplate = $tasktemplateRepository->find($request->query->get("id"));

        return $this->render('tasktemplate_view.twig', ['tasktemplate'=> $tasktemplate->toArray()]);
    }

    /**
     * @Route("/createtasktemplate", methods={"POST"})
     */
    public function create(Request$request, TaskTemplateRepository $tasktemplateRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['tasktemplateCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['tasktemplateUpdateFile'];
            $message_code = "update";
        }
        $title = $request->request->get('title');

        $params['title'] = $title;
        $params['project'] = empty($request->request->get('project')) ? "NULL" : $request->request->get('project');
        $params['startdate'] = $request->request->get('startdate');
        $params['enddate'] = empty($request->request->get('enddate')) ? "NULL" : $request->request->get('enddate');
        $params['assignee'] = empty($request->request->get('assignee')) ? "NULL" : $request->request->get('assignee');
        $params['parent'] = empty($request->request->get('parent')) ? "NULL" : $request->request->get('parent');
        $params['istimesheetasktemplate'] = empty($request->request->get('istimesheettasktemplate')) ? "0" : "1";
        $params['accountid'] = $this->getAccountId();

        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $tasktemplateRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $log_file_name = $username.".".time().".".$message_code."tasktemplate.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."tasktemplate/";
        $params['logfilename'] = $log_file_name;
        $params['createdby'] = $this->getUserId();

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData('tasktemplate', json_encode(array_merge(['message' => $message = $translator->trans("tasktemplate.".$message_code.".success")], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render('tasktemplate_table.twig', ['tasktemplates'=> $tasktemplateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error creating Task".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * Transform the tasktemplate details entered into an SQL statement that can be executed.
     *
     * The data format is data[projectid][date][hours]
     *
     * @param $data
     *
     */
    private function getSQLStatementForTaskDetails($data) {
        $query_string = "";
        foreach ($data as $projectid => $time) {
            $projectassignmentid = $time['projectassignmentid'];
            // remove the project assignment id to leave only the working time
            unset($time['projectassignmentid']);
            foreach ($time as $workday => $hours) {
                if (empty($hours)) {
                    $hours = 0;
                }
                $query_string.= "INSERT INTO tasktemplate_detail (`userid`, `accountid`, `projectid`, `tasktemplateid`, `projectassignmentid`, `workday`, `hours`) 
                                VALUES(".$this->getUserId().",".$this->getAccountId().",".$projectid.", @tasktemplate_id, ".$projectassignmentid.", '".$workday."',".$hours.");";

            }
        }

        return $query_string;
    }

    /**
     * @Route("/deletetasktemplate", methods={"GET"})
     */
    public function delete(Request $request, TaskTemplateRepository $tasktemplateRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['tasktemplateDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response($translator->trans("tasktemplate.delete.noid"), 500);
        }

        $params[] = $id;
        $uuid = $tasktemplateRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."tasktemplate/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".deletetasktemplate.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("tasktemplate.delete.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("tasktemplate", json_encode(['message' => $message, 'Task' => $id, 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("tasktemplate_table.twig", ['tasktemplates'=> $tasktemplateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error deleting the Task ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
}