<?php
namespace App\Controller;

use App\Helper\Utils;
use App\Repository\MPPStatusRepository;
use Aws\Sqs\SqsClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MPPStatusController extends BaseController {

    use Utils;
    /**
     * @Route("/creatempp", methods={"POST"})
     */
    public function creatempp(Request $request, MPPStatusRepository $mppStatusRepository,  SqsClient $queue) {
        $shell = $this->getParameter('shell')['mppCreateFile'];
        $translator = $this->get('translator');
        $uuid = $this->getUuid();
        $username = $this->getLoggedInUsername($this->getUser());
        $accountid = $this->getAccountId();

        // shell command parameters
        $category = str_replace(' ', '_', $request->request->get('category'));
        $params[] = $category;
        $params[] = $request->request->get('nodes');
        $params[] = $uuid;
        $params[] = $this->getAccountId();
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".creatempp.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."mpp/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("mpp.create.success", ["%category%" => $category]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("mpp", json_encode(['message' => $message, 'mpp' => $category, 'logfilename' => $log_file_name, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."mpp/"]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("mpp_table.twig", ['customReports'=> $mppStatusRepository->getAll($accountid)]);
        } else {
            $message = $translator->trans("mpp.create.fail", ["%category%" => $category]);
            return new Response("Error creating a mpp instance ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }

    }
    /**
     * @Route("/mpp", name="mpp")
     */
    public function index(MPPStatusRepository $mppStatusRepository) {
        return $this->render("mpp.twig", ['customReports'=> $mppStatusRepository->getAll($this->getAccountId())]);
    }
    /**
     * @Route("/mpp/refresh")
     */
    public function refresh(MPPStatusRepository $mppStatusRepository) {
        return $this->render("mpp_table.twig", ['customReports'=> $mppStatusRepository->getAll($this->getAccountId())]);
    }

    /**
     * @Route("/startmpp")
     */
    public function startmpp(Request $request, MPPStatusRepository $mppStatusRepository, SqsClient $queue, LoggerInterface $logger) {
        $shell = $this->getParameter('shell')['mppStartFile'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());

        $id = $request->request->get('id');
        $uuid = $mppStatusRepository->getUuidFromId($id);
        $params[] = $id;
        $params[] = $uuid;
        $params[] = ""; // was aws_credentials_key
        $params[] = ""; // was aws_credentials_secret
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".startmpp.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."mpp/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $logger->info("Starting mpp with uuid ".$uuid." with command ".$process->getCommandLine()." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed script to start mpp with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of starting mpp with uuid  ".$uuid." is ".$process->getOutput());

        $message = $translator->trans("mpp.start.success", ["%category%" => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("mpp", json_encode(['message' => $message, 'mpp_id' => $id, 'logfilename' => $log_file_name, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."mpp/"]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("mpp_table.twig", ['customReports'=> $mppStatusRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("mpp.start.fail", ["%category%" => $id]);
            return new Response("Error starting the mpp instance ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/stopmpp")
     */
    public function stopmpp(Request $request, MPPStatusRepository $mppStatusRepository,  SqsClient $queue, LoggerInterface $logger) {
        $shell = $this->getParameter('shell')['mppStopFile'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());

        $id = $request->request->get('id');
        $params[] = $id;
        $uuid = $mppStatusRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = ""; // was aws_credentials_key
        $params[] = ""; // was aws_credentials_secret
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".stopmpp.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."mpp/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $logger->info("Stopped mpp with uuid ".$uuid." with command ".$process->getCommandLine()." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed script to stop mpp with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of stopping mpp with uuid  ".$uuid." is ".$process->getOutput());


        $message = $translator->trans("mpp.stop.success", ["%category%" => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("mpp", json_encode(['message' => $message, 'mpp_id' => $id, 'logfilename' => $log_file_name, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."mpp/"]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("mpp_table.twig", ['customReports'=> $mppStatusRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("mpp.stop.fail", ["%category%" => $id]);
            return new Response("Error stopping the mpp instance ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

}