<?php
/**
 *
 */

namespace App\Controller;

use App\Entity\ProjectAssignment;
use App\Form\ProjectAssignmentType;
use App\Helper\Utils;
use App\Repository\AppUserRepository;
use App\Repository\ProjectAssignmentRepository;
use App\Repository\ProjectRepository;
use Aws\Sqs\SqsClient;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectAssignmentController extends BaseController {

    use Utils;

    /**
     * @Route("/projectassignment", name="projectassignment")
     */
    public function projects(Request $request, ProjectAssignmentRepository $projectAssignmentRepository) {

        $userid = '';
        if (!$this->isGranted('ROLE_TIMESHEET_ASSIGNMENT')) {
            $userid = $this->getUserId(); // username of SecurityUser is the userid
        }

        return $this->render("projectassignment.twig", ['projectassignments'=> $projectAssignmentRepository->getAll($this->getAccountId(), $userid), 'projectassignment' => new ProjectAssignment(), 'form' => $this->createForm(ProjectAssignmentType::class, new ProjectAssignment(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/projectassignment/refresh")
     */
    public function refresh(ProjectAssignmentRepository $projectAssignmentRepository, AppUserRepository $appUserRepository, ProjectRepository $projectRepository) {
        $userid = '';
        if (!$this->isGranted('ROLE_TIMESHEET_ASSIGNMENT')) {
            $userid = $this->getUserId();
        }
        return $this->render("projectassignment_table.twig", ['projectassignments'=> $projectAssignmentRepository->getAll($this->getAccountId(), $userid), 'projectassignment' => new ProjectAssignment(), 'form' => $this->createForm(ProjectAssignmentType::class, new ProjectAssignment(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/createprojectassignment", methods={"POST"})
     */
    public function create(Request$request, ProjectAssignmentRepository $projectAssignmentRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['projectAssignmentCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['projectAssignmentUpdateFile'];
            $message_code = "update";
        }
        $assignment_user = $request->request->get('user');
        $assignment_project = $request->request->get('project');

        $params['user'] = $assignment_user;
        $params['projectid'] = $assignment_project;
        $params['startdate'] = $request->request->get('startdate');
        $params['enddate'] = $request->request->get('enddate');
        $params['maximumhoursperday'] = $request->request->get('maximumhoursperday');
        $params['maximumhoursperweek'] = $request->request->get('maximumhoursperweek');
        $params['saturdayworkallowed'] = empty($request->request->get('saturdayworkallowed')) ? "0": "1";
        $params['sundayworkallowed'] = empty($request->request->get('sundayworkallowed')) ? "0" : "1";
        $params['publicholidayworkallowed'] = empty($request->request->get('publicholidayworkallowed')) ? "0" : "1";
        $params['regularrate'] = $request->request->get('regularrate');
        $params['overtimerate'] = $request->request->get('overtimerate');
        $params['approvername'] = $request->request->get('approvername');
        $params['approveremail'] = $request->request->get('approveremail');

        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $projectAssignmentRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params['accountid'] = $this->getAccountId();
        $log_file_name = $username.".".time().".".$message_code."project.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."project/";
        $params['logfilename'] = $log_file_name;
        $params['createdby'] = $this->getUserName();

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("projectassignment", json_encode(array_merge(['message' => $message = $translator->trans("projectassignment.".$message_code.".success")], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("projectassignment_table.twig", ['projectassignments'=> $projectAssignmentRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error creating Project Assignment".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/editprojectassignment", methods={"GET"})
     */
    public function edit(Request $request) {
        $project = $this->getDoctrine()->getRepository(ProjectAssignment::class)->find($request->query->get("id"));

        return $this->render("projectassignment_form.twig", ['projectassignment'=> $project->toArray()]);
    }
    /**
     * @Route("/viewprojectassignment", methods={"GET"})
     */
    public function view(Request $request) {
        $project = $this->getDoctrine()->getRepository(ProjectAssignment::class)->find($request->query->get("id"));

        return $this->render("projectassignment_view.twig", ['projectassignment'=> $project->toArray()]);
    }


    /**
     * @Route("/deleteprojectassignment", methods={"GET"})
     */
    public function delete(Request $request, ProjectAssignmentRepository $projectAssignmentRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['projectAssignmentDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response($translator->trans("projectassignment.delete.noid"), 500);
        }

        $params[] = $id;
        $uuid = $projectAssignmentRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."projectassignment/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".deleteprojectassignment.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("projectassignment.delete.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("projectassignment", json_encode(['message' => $message, 'Project Assignment' => $id, 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("projectassignment_table.twig", ['projectassignments'=> $projectAssignmentRepository->getAll($this->getAccountId()), 'projectassignment' => new ProjectAssignment(), 'form' => $this->createForm(ProjectAssignmentType::class, new ProjectAssignment(), array('account' => $this->getAccountId()))->createView()]);
        } else {
            return new Response("Error deleting the Project Assignment ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

}