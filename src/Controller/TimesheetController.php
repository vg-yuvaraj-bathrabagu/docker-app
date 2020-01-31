<?php
/**
 * Timesheet Submissions
 */

namespace App\Controller;

use App\Entity\Timesheet;
use App\Helper\Utils;
use App\Repository\ProjectAssignmentRepository;
use App\Repository\TimesheetDetailRepository;
use App\Repository\TimesheetRepository;
use Aws\Sqs\SqsClient;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimesheetController extends BaseController {

    use Utils;

    /**
     * @Route("/timesheet", name="timesheet")
     */
    public function timesheet(Request $request, TimesheetRepository $timesheetRepository, ProjectAssignmentRepository $projectAssignmentRepository) {
        $timesheet = new Timesheet();
        return $this->render('timesheet.twig', ['timesheets' => $timesheetRepository->getAll($this->getAccountId()), "timesheet" => $timesheet->toArray(), "projectassignments" => $projectAssignmentRepository->getAll($this->getAccountId(), '', $request->get('weekstartdate')), 'userid' => $this->getUserId(), 'user'=> $this->getAppUserInstance($this->getUser())]);
    }

    /**
     * @Route("/newtimesheet")
     */
    public function new(Request $request, TimesheetRepository $timesheetRepository, ProjectAssignmentRepository $projectAssignmentRepository) {
        $timesheet = new Timesheet();
        return $this->render('timesheet_form.twig', ["projectassignments" => $projectAssignmentRepository->getAll($this->getAccountId(), $request->get('userid'), $request->get('weekstartdate'), $request->get('weekenddate')), 'weekstartdate' => $request->get('weekstartdate'), 'weekenddate' => $request->get('weekenddate'),  "timesheet" => $timesheet->toArray(), 'userid' => $this->getUserId(), 'user' => $this->getAppUserInstance($this->getUser())]);
    }

    /**
     * @Route("/timesheet/refresh")
     */
    public function refresh(TimesheetRepository $timesheetRepository) {
        $timesheet = new Timesheet();
        return $this->render('timesheet_table.twig', ['timesheets' => $timesheetRepository->getAll($this->getAccountId()), "timesheet" => $timesheet->toArray(), 'user' => $this->getAppUserInstance($this->getUser())]);
    }

    /**
     * @Route("/edittimesheet", methods={"GET"})
     */
    public function edit(Request $request) {
        $timesheet = $this->getDoctrine()->getRepository(Timesheet::class)->find($request->query->get("id"));

        return $this->render("timesheet_form.twig", ['timesheet'=> $timesheet->toArray()]);
    }
    /**
     * @Route("/viewtimesheet", methods={"GET"})
     */
    public function view(Request $request, TimesheetRepository $timesheetRepository, TimesheetDetailRepository $timesheetDetailRepository) {
        $timesheet = $timesheetRepository->find($request->query->get("id"));

        return $this->render("timesheet_view.twig", ['timesheet'=> $timesheet->toArray(), 'timesheetdetails' => $timesheetDetailRepository->getFromTimesheet($request->query->get("id")), 'user' => $this->getAppUserInstance($this->getUser())]);
    }

    /**
     * @Route("/createtimesheet", methods={"POST"})
     */
    public function create(Request$request, TimesheetRepository $timesheetRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['timesheetCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['timesheetUpdateFile'];
            $message_code = "update";
        }
        $userid = $request->request->get('userid');

        $params['userid'] = $userid;
        $params['start'] = $request->request->get('start');
        $params['end'] = $request->request->get('end');
        $params['accountid'] = $this->getAccountId();
        $params[] = $this->getSQLStatementForTimesheetDetails( $request->request->get('detail'));

        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $timesheetRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $log_file_name = $username.".".time().".".$message_code."timesheet.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."timesheet/";
        $params['logfilename'] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        // add the array of timesheet details for processing
        $params['timesheet_detail_data'] = $request->request->get('detail');

        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("timesheet", json_encode(array_merge(['message' => $message = $translator->trans("timesheet.".$message_code.".success")], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("timesheet_table.twig", ['timesheets'=> $timesheetRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error creating Timesheet".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * Transform the timesheet details entered into an SQL statement that can be executed.
     *
     * The data format is data[projectid][date][hours]
     *
     * @param $data
     *
     */
    private function getSQLStatementForTimesheetDetails($data) {
        $query_string = "";
        foreach ($data as $projectid => $time) {
            $projectassignmentid = $time['projectassignmentid'];
            $taskid = $time['taskid'];
            // remove the project assignment id to leave only the working time
            unset($time['projectassignmentid']);
            unset($time['taskid']);
            foreach ($time as $workday => $hours) {
                if (empty($hours)) {
                    $hours = 0;
                }
                $query_string.= "INSERT INTO timesheet_detail (`userid`, `accountid`, `projectid`, `timesheetid`, `projectassignmentid`, `workday`, `hours`, `taskid`) 
                                VALUES(".$this->getUserId().",".$this->getAccountId().",".$projectid.", @timesheet_id, ".$projectassignmentid.", '".$workday."',".$hours.",".$taskid.");";

            }
        }

        return $query_string;
    }

    /**
     * @Route("/deletetimesheet", methods={"GET"})
     */
    public function delete(Request $request, TimesheetRepository $timesheetRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['timesheetDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response($translator->trans("timesheet.delete.noid"), 500);
        }

        $params[] = $id;
        $uuid = $timesheetRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."timesheet/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".deletetimesheet.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("timesheet.delete.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("timesheet", json_encode(['message' => $message, 'Timesheet' => $id, 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("timesheet_table.twig", ['timesheets'=> $timesheetRepository->getAll($this->getAccountId())]);
        } else {
            return new Response("Error deleting the Timesheet ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
}