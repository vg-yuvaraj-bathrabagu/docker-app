<?php
/**
 * Controller for FileWatcher
 */

namespace App\Controller;

use App\Entity\FileWatcher;
use App\Form\FileWatcherType;
use App\Helper\Utils;
use App\Repository\FileWatcherRepository;
use Aws\Sqs\SqsClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileWatcherController extends BaseController {

    use Utils;

    /**
     * @Route("/watcher", name="watcher")
     */
    public function watcher(FileWatcherRepository $filewatcherRepository) {
        $filewatcher = new FileWatcher();
        return $this->render("filewatcher.twig", ["filewatchers"=> $filewatcherRepository->getAll($this->getAccountId()), "filewatcher" => $filewatcher->toArray(), 'form' => $this->createForm(FileWatcherType::class)->createView()]);
    }

    /**
     * @Route("/filewatcher/refresh")
     */
    public function refresh(FileWatcherRepository $filewatcherRepository) {
        $filewatcher = new FileWatcher();
        return $this->render("filewatcher_table.twig",['filewatchers'=> $filewatcherRepository->getAll($this->getAccountId()), "filewatcher" => $filewatcher->toArray(),'form' => $this->createForm(FileWatcherType::class)->createView()]);
    }
    /**
     * @Route("/createfilewatcher", methods={"POST"})
     */
    public function create(Request$request, FileWatcherRepository $filewatcherRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['filewatcherCreateFile'];

        } else {
            $shell = $this->getParameter('shell')['filewatcherUpdateFile'];
            $message_code = "update";
        }

        $params['title'] = $request->request->get('title');
        $type = $request->request->get('type');
        $params['type'] = $type;
        $params['description'] = $request->request->get('description');
        $params['querystring'] = $request->request->get('querystring');
        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $filewatcherRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = $this->getAccountId();
        $log_file_name = $username.".".time().".".$message_code."filewatcher.".$uuid.".log";
        
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."filewatcher/";
        $params[] = $log_file_name;
        $params['securitypolicy'] = $request->request->get('securitypolicy');
        $params['simulationid'] = $request->request->get('simulationid');
        $params['templateid'] = $request->request->get('templateid');
        $params['bucket'] = $request->request->get('bucket');
        $params['schedule'] = $request->request->get('schedule');

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("filewatcher.$message_code.success", ["%category%" => $type]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("filewatcher", json_encode(array_merge(['message' => $message, 'FileWatcher' => $type], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("filewatcher_table.twig", ['filewatchers'=> $filewatcherRepository->getAll($this->getAccountId()),'form' => $this->createForm(FileWatcherType::class)->createView()]);
        } else {
            $message = $translator->trans("filewatcher.$message_code.fail");
            return new Response("Error creating File Watcher ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }


    }

    /**
     * @Route("/editfilewatcher", methods={"GET"})
     */
    public function edit(Request $request) {
        $filewatcher = $this->getDoctrine()->getRepository(FileWatcher::class)->find($request->query->get("id"));

        return $this->render("filewatcher_form.twig", ['filewatcher'=> $filewatcher->toArray(),'form' => $this->createForm(FileWatcherType::class)->createView()]);
    }
    /**
     * @Route("/viewfilewatcher", methods={"GET"})
     */
    public function view(Request $request) {
        $filewatcher = $this->getDoctrine()->getRepository(FileWatcher::class)->find($request->query->get("id"));

        return $this->render("filewatcher_view.twig", ['filewatcher'=> $filewatcher->toArray(),'form' => $this->createForm(FileWatcherType::class)->createView()]);
    }

    /**
     * @Route("/deletefilewatcher", methods={"GET"})
     */
    public function delete(Request $request, FileWatcherRepository $filewatcherRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['filewatcherDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            throw new \Exception($translator->trans("filewatcher.delete.noid"));
        }

        $params[] = $id;
        $uuid = $filewatcherRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."filewatcher/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');

        $log_file_name = $username.".".time().".deletefilewatcher.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("filewatcher.delete.success");
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("filewatcher", json_encode(['message' => $message, 'FileWatcher' => $id]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("filewatcher_table.twig", ['filewatchers'=> $filewatcherRepository->getAll($this->getAccountId()), 'form' => $this->createForm(FileWatcherType::class)->createView()]);
        } else {
            $message = $translator->trans("filewatcher.delete.fail");
            return new Response("Error deleting the File Watcher ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/runfilewatcher", methods={"GET"})
     */
    public function run(Request $request, FileWatcherRepository $fileWatcherRepository, SqsClient $queue, LoggerInterface $logger) {
        $shell = $this->getParameter('shell')['filewatcherRunFile'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());

        $id = $request->query->get('id');
        $filewatcher = $fileWatcherRepository->find($id);
        $values = $filewatcher->toArray();
        $uuid = $values['uuid'];
        $params['id'] = $id;
        $params['title'] = $values['title'];
        $params['category'] = $values['category'];
        $params['bucket'] = $values['bucket'];
        $params['description'] = $values['description'];
        $params['querystring'] = $values['querystring'];
        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $params[] = $uuid;
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".runfilewatcher.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params['s3outputfolder'] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."filewatcher/";
        $params[] = $this->getParameter('s3.presignduration');
        $params['logfilename'] = $log_file_name;

        $type = $request->query->get('type');

        if ($type == 'background') {
            $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name, true);
        } else {
            // run as foreground task
            $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        }

        $logger->info("Starting filewatcher run with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed filewatcher run with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of filewatcher run with uuid  ".$uuid." is ".$process->getOutput());

        $message = $translator->trans("filewatcher.run.success", ["%category%" => $values['category']]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("filewatcher", json_encode(array_merge(['message' => $message, 'FileWatcher' => $id], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            if ($type == 'background') {
                return $this->render("filewatcher_table.twig", ['filewatchers'=> $fileWatcherRepository->getAll($this->getAccountId()), 'form' => $this->createForm(FileWatcherType::class)->createView()]);
            } else {
                return $this->render("filewatcher_results.twig", ['output'=> $this->getShellScriptLogFileContents($log_file_name)]);
            }
        } else {
            $message = $translator->trans("filewatcher.run.fail", ["%category%" => $values['category']]);
            return $this->render("filewatcher_results.twig", ['error'=> $this->getShellScriptLogFileContents($log_file_name)]);
        }
    }
}