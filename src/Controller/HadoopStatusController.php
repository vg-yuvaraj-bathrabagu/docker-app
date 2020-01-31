<?php
namespace App\Controller;

use App\Helper\Utils;
use App\Repository\HadoopStatusRepository;
use Aws\Sqs\SqsClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HadoopStatusController extends BaseController {

    use Utils;
    /**
     * @Route("/createhadoop", methods={"POST"})
     */
    public function createHadoop(Request $request, HadoopStatusRepository $hadoopStatusRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['hadoopCreateFile'];
        $translator = $this->get('translator');
        $uuid = $this->getUuid();
        $username = $this->getLoggedInUsername($this->getUser());

        // shell command parameters
        $category = str_replace(' ', '_', $request->request->get('category'));
        $params[] = $category;
        $params[] = $request->request->get('nodes');
        $params[] = $uuid;
        $params[] = $this->getAccountId();
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".createhadoop.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."hadoop/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("hadoop.create.success", ["%category%" => $category]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("hadoop", json_encode(['message' => $message, 'Hadoop' => $category, 'logfilename' => $log_file_name, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."hadoop/"]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("hadoop_table.twig", ['customReports'=> $hadoopStatusRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("hadoop.create.fail", ["%category%" => $category]);
            return new Response("Error creating a hadoop instance ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
    /**
     * @Route("/hadoop", name="hadoop")
     */
    public function index(HadoopStatusRepository $hadoopStatusRepository) {
        return $this->render("hadoop.twig", ['customReports'=> $hadoopStatusRepository->getAll($this->getAccountId())]);
    }

    /**
     * @Route("/hadoop/refresh")
     */
    public function refresh(HadoopStatusRepository $hadoopStatusRepository) {
        return $this->render("hadoop_table.twig", ['customReports'=> $hadoopStatusRepository->getAll($this->getAccountId())]);
    }

    /**
     * @Route("/starthadoop")
     */
    public function startHadoop(Request $request, HadoopStatusRepository $hadoopStatusRepository, SqsClient $queue, LoggerInterface $logger) {
        $shell = $this->getParameter('shell')['hadoopStartFile'];
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = $hadoopStatusRepository->getUuidFromId($id);
        $username = $this->getLoggedInUsername($this->getUser());

        $params[] = $id;
        $params[] = $uuid;
        $params[] = ""; // was aws_credentials_key
        $params[] = ""; // was aws_credentials_secret
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".starthadoop.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."hadoop/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $logger->info("Starting hadoop with uuid ".$uuid." with command ".$process->getCommandLine()." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed script to start hadoop with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of starting hadoop with uuid  ".$uuid." is ".$process->getOutput());

        $message = $translator->trans("hadoop.start.success", ["%category%" => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("hadoop", json_encode(['message' => $message, 'hadoop_id' => $id, 'logfilename' => $log_file_name, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."hadoop/"]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("hadoop_table.twig", ['customReports'=> $hadoopStatusRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("hadoop.start.fail", ["%category%" => $id]);
            return new Response("Error starting the hadoop instance ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }



    }

    /**
     * @Route("/stophadoop")
     */
    public function stopHadoop(Request $request, HadoopStatusRepository $hadoopStatusRepository, SqsClient $queue, LoggerInterface $logger) {
        $shell = $this->getParameter('shell')['hadoopStopFile'];
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $username = $this->getLoggedInUsername($this->getUser());
        $accountid = $this->getAccountId();

        $params[] = $id;
        $uuid = $hadoopStatusRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = ""; // was aws_credentials_secret
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".stophadoop.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."hadoop/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $logger->info("Stopped hadoop with uuid ".$uuid." with command ".$process->getCommandLine()." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed script to stop hadoop with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of stopping hadoop with uuid  ".$uuid." is ".$process->getOutput());


        $message = $translator->trans("hadoop.stop.success", ["%category%" => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("hadoop", json_encode(['message' => $message, 'hadoop_id' => $id, 'logfilename' => $log_file_name, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."hadoop/"]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("hadoop_table.twig", ['customReports'=> $hadoopStatusRepository->getAll($accountid)]);
        } else {
            $message = $translator->trans("hadoop.stop.fail", ["%category%" => $id]);
            return new Response("Error stopping the hadoop instance ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

}