<?php
/**
 * Tasks 
 */

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Helper\Utils;
use App\Repository\ProjectAssignmentRepository;
use App\Repository\TaskRepository;
use Aws\Sqs\SqsClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends BaseController {

    use Utils;

    /**
     * @Route("/task", name="task")
     */
    public function task(Request $request, TaskRepository $taskRepository) {
        $task = new Task();
        return $this->render('task.twig', ['tasks' => $taskRepository->getAll($this->getAccountId()), "task" => $task->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(TaskType::class, new Task(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/newtask")
     */
    public function new(Request $request, TaskRepository $taskRepository, ProjectAssignmentRepository $projectAssignmentRepository) {
        $task = new Task();
        return $this->render('task_form.twig', [ "task" => $task->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(TaskType::class, new Task(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/task/refresh")
     */
    public function refresh(TaskRepository $taskRepository) {
        $task = new Task();
        return $this->render('task_table.twig', ['tasks' => $taskRepository->getAll($this->getAccountId()), "task" => $task->toArray(), 'form' => $this->createForm(TaskType::class, new Task(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/edittask", methods={"GET"})
     */
    public function edit(Request $request) {
        $task = $this->getDoctrine()->getRepository(Task::class)->find($request->query->get("id"));

        return $this->render("task_form.twig", ['task'=> $task->toArray(), 'form' => $this->createForm(TaskType::class, new Task(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/blanktask", methods={"GET"})
     */
    public function blank(Request $request) {
        $task = new Task();

        return $this->render("task_form.twig", ['task'=> $task->toArray(), 'form' => $this->createForm(TaskType::class, new Task(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/viewtask", methods={"GET"})
     */
    public function view(Request $request, TaskRepository $taskRepository) {
        $task = $taskRepository->find($request->query->get("id"));

        return $this->render("task_view.twig", ['task'=> $task->toArray()]);
    }

    /**
     * @Route("/createtask", methods={"POST"})
     */
    public function create(Request$request, TaskRepository $taskRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['taskCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['taskUpdateFile'];
            $message_code = "update";
        }
        $title = $request->request->get('title');

        $params['title'] = $title;
        $params['project'] = empty($request->request->get('project')) ? "NULL" : $request->request->get('project');
        $params['startdate'] = $request->request->get('startdate');
        $params['enddate'] = empty($request->request->get('enddate')) ? "NULL" : $request->request->get('enddate');
        $params['assignee'] = empty($request->request->get('assignee')) ? "NULL" : $request->request->get('assignee');
        $params['parent'] = empty($request->request->get('parent')) ? "NULL" : $request->request->get('parent');
        $params['istimesheetask'] = empty($request->request->get('istimesheettask')) ? "0" : "1";
        $params['accountid'] = $this->getAccountId();

        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $taskRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $log_file_name = $username.".".time().".".$message_code."task.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."task/";
        $params['logfilename'] = $log_file_name;
        $params['createdby'] = $this->getUserId();

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("task", json_encode(array_merge(['message' => $message = $translator->trans("task.".$message_code.".success")], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("task_table.twig", ['tasks'=> $taskRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error creating Task".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * Transform the task details entered into an SQL statement that can be executed.
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
                $query_string.= "INSERT INTO task_detail (`userid`, `accountid`, `projectid`, `taskid`, `projectassignmentid`, `workday`, `hours`) 
                                VALUES(".$this->getUserId().",".$this->getAccountId().",".$projectid.", @task_id, ".$projectassignmentid.", '".$workday."',".$hours.");";

            }
        }

        return $query_string;
    }

    /**
     * @Route("/deletetask", methods={"GET"})
     */
    public function delete(Request $request, TaskRepository $taskRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['taskDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response($translator->trans("task.delete.noid"), 500);
        }

        $params[] = $id;
        $uuid = $taskRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."task/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".deletetask.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("task.delete.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("task", json_encode(['message' => $message, 'Task' => $id, 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("task_table.twig", ['tasks'=> $taskRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error deleting the Task ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
}