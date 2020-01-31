<?php
/**
 * Taskqueue Submissions
 */

namespace App\Controller;

use App\Entity\TaskQueue;
use App\Form\TaskQueueType;
use App\Helper\Utils;
use App\Repository\ProjectAssignmentRepository;
use App\Repository\TaskQueueRepository;
use Aws\Sqs\SqsClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskQueueController extends BaseController {

    use Utils;

    /**
     * @Route("/taskqueue", name="taskqueue")
     */
    public function taskqueue(Request $request, TaskQueueRepository $taskqueueRepository, ProjectAssignmentRepository $taskAssignmentRepository) {
        $taskqueue = new TaskQueue();
        return $this->render('taskqueue.twig', ['taskqueues' => $taskqueueRepository->getAll($this->getAccountId()),
            "taskqueue" => $taskqueue->toArray(),
            "projectassignments" => $taskAssignmentRepository->getAll($this->getAccountId(), '', $request->get('weekstartdate')),
            'userid' => $this->getUserId(),
            'form' => $this->createForm(TaskQueueType::class, new TaskQueue(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/newtaskqueue")
     */
    public function new(Request $request, TaskQueueRepository $taskqueueRepository, ProjectAssignmentRepository $taskAssignmentRepository) {
        $taskqueue = new Taskqueue();
        return $this->render('taskqueue_form.twig', ["projectassignments" => $taskAssignmentRepository->getAll($this->getAccountId(), $request->get('userid'), $request->get('weekstartdate')), 'weekstartdate' => $request->get('weekstartdate'), 'weekenddate' => $request->get('weekenddate'),  "taskqueue" => $taskqueue->toArray(), 'userid' => $this->getUserId()]);
    }

    /**
     * @Route("/taskqueue/refresh")
     */
    public function refresh(TaskQueueRepository $taskqueueRepository) {
        $taskqueue = new Taskqueue();
        return $this->render('taskqueue_table.twig', ['taskqueues' => $taskqueueRepository->getAll($this->getAccountId()), "taskqueue" => $taskqueue->toArray()]);
    }

    /**
     * @Route("/edittaskqueue", methods={"GET"})
     */
    public function edit(Request $request) {
        $taskqueue = $this->getDoctrine()->getRepository(Taskqueue::class)->find($request->query->get("id"));

        return $this->render("taskqueue_form.twig", ['taskqueue'=> $taskqueue->toArray()]);
    }
    /**
     * @Route("/viewtaskqueue", methods={"GET"})
     */
    public function view(Request $request, TaskQueueRepository $taskqueueRepository) {
        $taskqueue = $taskqueueRepository->find($request->query->get("id"));

        return $this->render("taskqueue_view.twig", ['taskqueue'=> $taskqueue->toArray()]);
    }

    /**
     * @Route("/createtaskqueue", methods={"POST"})
     */
    public function create(Request$request, TaskQueueRepository $taskqueueRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['taskqueueCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['taskqueueUpdateFile'];
            $message_code = "update";
        }
        $userid = $request->request->get('userid');

        $params['userid'] = $userid;
        $params['start'] = $request->request->get('start');
        $params['end'] = $request->request->get('end');
        $params['accountid'] = $this->getAccountId();
        $params[] = $this->getSQLStatementForTaskqueueDetails( $request->request->get('detail'));

        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $taskqueueRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $log_file_name = $username.".".time().".".$message_code."taskqueue.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."taskqueue/";
        $params['logfilename'] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        // add the array of taskqueue details for processing
        $params['taskqueue_detail_data'] = $request->request->get('detail');

        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("taskqueue", json_encode(array_merge(['message' => $message = $translator->trans("taskqueue.".$message_code.".success")], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("taskqueue_table.twig", ['taskqueues'=> $taskqueueRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error creating Taskqueue".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * Transform the taskqueue details entered into an SQL statement that can be executed.
     *
     * The data format is data[projectid][date][hours]
     *
     * @param $data
     *
     */
    private function getSQLStatementForTaskqueueDetails($data) {
        $query_string = "";
        foreach ($data as $projectid => $time) {
            $projectassignmentid = $time['projectassignmentid'];
            // remove the project assignment id to leave only the working time
            unset($time['projectassignmentid']);
            foreach ($time as $workday => $hours) {
                if (empty($hours)) {
                    $hours = 0;
                }
                $query_string.= "INSERT INTO taskqueue_detail (`userid`, `accountid`, `projectid`, `taskqueueid`, `projectassignmentid`, `workday`, `hours`) 
                                VALUES(".$this->getUserId().",".$this->getAccountId().",".$projectid.", @taskqueue_id, ".$projectassignmentid.", '".$workday."',".$hours.");";

            }
        }

        return $query_string;
    }

    /**
     * @Route("/deletetaskqueue", methods={"GET"})
     */
    public function delete(Request $request, TaskQueueRepository $taskqueueRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['taskqueueDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response($translator->trans("taskqueue.delete.noid"), 500);
        }

        $params[] = $id;
        $uuid = $taskqueueRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."taskqueue/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".deletetaskqueue.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("taskqueue.delete.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("taskqueue", json_encode(['message' => $message, 'Taskqueue' => $id, 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("taskqueue_table.twig", ['taskqueues'=> $taskqueueRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error deleting the Taskqueue ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
}