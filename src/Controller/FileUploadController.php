<?php
/**
 * Controller for handling file uploads to S3
 */

namespace App\Controller;


use App\Helper\Utils;
use App\Repository\AppUserRepository;
use App\Repository\FileUploadRepository;
use App\Repository\TemplateRepository;
use Aws\Sqs\SqsClient;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileUploadController extends BaseController
{
    use Utils;

    /**
     * @Route("/upload", name="upload")
     */
    public function upload(TemplateRepository $templateRepository) {
        return $this->render("upload.twig", ['templates' => $templateRepository->getAll($this->getAccountId())]);
    }

    /**
     * @Route("/uploads", name="uploads")
     */
    public function uploads(Request $request, FileUploadRepository $fileUploadRepository, TemplateRepository $templateRepository) {
        return $this->render("upload_files.twig",
            ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), "show_status" => $request->query->get('show_status'), "show_trash" => $request->query->get('show_trash'),
                'templates' => $templateRepository->getAll($this->getAccountId())]);
    }

    /**
     * @Route("/processs3")
     */
    public function processS3Upload(Request $request, TemplateRepository $templateRepository, FileUploadRepository $fileUploadRepository, SqsClient $sqsClient, AppUserRepository $userRepository, AdapterInterface $cache) {
        $translator = $this->get('translator');
        $file = $request->files->get('file');
        $size = 0;
        $file_name_without_template_prefix = "";

        $template = $templateRepository->find($request->request->get('template'));
        $template_info = $template->toArray();

        $user = $userRepository->findOneBy(array("id" => $this->getUserId()));
        $user_details = $user->toArray();

        try {

            $file_name_without_template_prefix = $this->removeAllNonAlphanumericFromFileNameCharacters($file->getClientOriginalName());
            // prefix the name of the file with the name of the template
            $file_name_with_template_prefix = $template_info['name'].".".$file_name_without_template_prefix;

            $duplicate_file = $fileUploadRepository->findOneBy(array("name" => $file_name_with_template_prefix, "templateid" => $template_info['id']));

            if ($duplicate_file != null) {
                return new Response($translator->trans('file.upload.duplicate', ['%filename%'=> $file->getClientOriginalName(), '%template%' => $template_info['name']] ), 500);
            }

            $file->move($this->getTemporaryUploadDirectoryForS3(), $file_name_without_template_prefix);
            $size = filesize($this->getTemporaryUploadDirectoryForS3().DIRECTORY_SEPARATOR.$file_name_without_template_prefix);
        } catch (FileException $e) {
            return new Response($translator->trans('file.upload.fail', ['%filename%'=> $file->getClientOriginalName()] )." ".$e->getMessage(), 500);
        }

        $shell = $this->getParameter('shell')['fileuploadCreateFile'];

        $uuid = $this->getUuid()->toString();
        $username = $this->getLoggedInUsername($this->getUser());
        $action = "S3FileUpload";

        // Nov 1, 2018 - each file is uploaded into the text directory plus another directory matching its own name
        // if the user file upload location is Shared, then
        if ($user_details['fileuploadlocation'] == "Shared") {
            $s3_folder_text = 'data/'.$this->getS3FolderNameForAccount()."/shared/template/".$template_info['name']."/Text/".$file_name_with_template_prefix."/";
            $s3_folder_format = 'data/'.$this->getS3FolderNameForAccount()."/shared/template/".$template_info['name']."/".$template_info['format']."/".$file_name_with_template_prefix."/";
        } else {
            $s3_folder_text = 'data/'.$this->getS3FolderNameForAccount()."/home/".$username."/intake/template/".$template_info['name']."/Text/".$file_name_with_template_prefix."/";
            $s3_folder_format = 'data/'.$this->getS3FolderNameForAccount()."/home/".$username."/intake/template/".$template_info['name']."/".$template_info['format']."/".$file_name_with_template_prefix."/";
        }


        $params[] = $file_name_with_template_prefix;
        $params[] = $this->getTemporaryUploadDirectoryForS3().DIRECTORY_SEPARATOR.$file_name_without_template_prefix;
        $params[] = $s3_folder_text;
        $params[] = $template_info['id'];
        $params[] = $action;
        $params[] = $size;
        $params[] = $uuid;
        $params[] = $this->getUser()->getUsername();
        $params[] = $username;
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $template_info['format'];
        $params[] = $template_info['tablename'];
        $params[] = $template_info['bucketoutput'];
        $params[] = $this->getParameter('athena_database');
        $params[] = $template_info['type'];

        $log_file_name = $username.".".time().".uploadfile.".$uuid.".log";
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $s3_folder_format;
        $params[] = $template_info['delimiter'];

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("s3.upload.success", ["%filename%" => $file_name_with_template_prefix]);
        if ($process->isSuccessful()) {
            $message = ['action' => $action,
                'fileName' => $file_name_with_template_prefix,
                'path' => $s3_folder_text,
                'templateid' => $template_info['id'],
                'templatename' => $template_info['name'],
                'templateuuid' => $template_info['uuid'],
                'templatepath' => $template_info['bucketinput'],
                'tablename' => $template_info['tablename'],
                'format' => $template_info['format']
            ];

            $actionArray['s3'] = $action;
            $queueData = $this->buildQueueData("s3", json_encode($message), $this->getUser(), $uuid);
            $sqsClient->sendMessage($queueData);

            // file uploaded - clear the Nexus Application Cache
            $cache->deleteItem($this->getNexusDateListCacheKey());


            return $this->render("upload_files.twig", ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), 'templates' => $templateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response($translator->trans('s3.upload.fail', ['%filename%'=> $file->getClientOriginalName()] )." ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }


    }

    /**
     * @Route("/copyorc");
     */
    public function copyORC(Request $request, FileUploadRepository $fileUploadRepository, TemplateRepository $templateRepository, SqsClient $sqsClient) {
        $shell = $this->getParameter('shell')['orcConversion'];
        $translator = $this->get('translator');

        $username = $this->getLoggedInUsername($this->getUser());
        $id = $request->request->get('file');
        $file_info = $fileUploadRepository->find($id)->toArray();
        $uuid = $this->getUuid();
        $template_info = $templateRepository->find($file_info['templateid'])->toArray();
        $action = "CopyORC";
        $template_directory = 'data/'.$this->getS3FolderNameForAccount().'/home/'.$username.'/template/'.$template_info['name'].'/'.$template_info['format'].'/';

        $params[] = $file_info['name'];
        $params[] = $file_info['folder'];
        $params[] = $file_info['templateid'];
        $params[] = $action;
        $params[] = $file_info['size'];
        $params[] = $uuid;
        $params[] = $file_info['uploadedby'];
        $params[] = $username;
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');

        $log_file_name = $username.".".time().".copyorc.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("s3.copyorc.success", ["%filename%" => $file_info['name']]);
        if ($process->isSuccessful()) {
            $message = ['action' => $action,
                'fileName' => $file_info['name'],
                'path' => $template_directory,
                'templateid' => $template_info['id'],
                'templatename' => $template_info['name'],
                'templateuuid' => $template_info['uuid'],
                'templatepath' => $template_info['bucketinput'],
                'tablename' => $template_info['tablename'],
                'format' => $template_info['format']
            ];

            $actionArray['s3'] = $action;
            $queueData = $this->buildQueueData("s3", json_encode($message), $this->getUser(), $uuid);
            $sqsClient->sendMessage($queueData);

            return $this->render("upload_files.twig", ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), 'templates' => $templateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response($translator->trans("s3.copyorc.fail", ["%filename%" => $file_info['name']])." ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/copypar");
     */
    public function copyParquet(Request $request, FileUploadRepository $fileUploadRepository, TemplateRepository $templateRepository, SqsClient $sqsClient) {
        $shell = $this->getParameter('shell')['parquetConversion'];
        $translator = $this->get('translator');

        $username = $this->getLoggedInUsername($this->getUser());
        $id = $request->request->get('file');
        $file_info = $fileUploadRepository->find($id)->toArray();
        $uuid = $this->getUuid();
        $template_info = $templateRepository->find($file_info['templateid'])->toArray();
        $action = "CopyParquet";
        $template_directory = 'data/'.$this->getS3FolderNameForAccount().'/'.$username.'/template/'.$template_info['name'].'/'.$template_info['format'].'/';

        $params[] = $file_info['name'];
        $params[] = $file_info['folder'];
        $params[] = $file_info['templateid'];
        $params[] = $action;
        $params[] = $file_info['size'];
        $params[] = $uuid;
        $params[] = $file_info['uploadedby'];
        $params[] = $username;
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');

        $log_file_name = $username.".".time().".copyparquet.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("s3.copyparquet.success", ["%filename%" => $file_info['name']]);
        if ($process->isSuccessful()) {
            $message = ['action' => $action,
                'fileName' => $file_info['name'],
                'path' => $template_directory,
                'templateid' => $template_info['id'],
                'templatename' => $template_info['name'],
                'templateuuid' => $template_info['uuid'],
                'templatepath' => $template_info['bucketinput'],
                'tablename' => $template_info['tablename'],
                'format' => $template_info['format']
            ];

            $actionArray['s3'] = $action;
            $queueData = $this->buildQueueData("s3", json_encode($message), $this->getUser(), $uuid);
            $sqsClient->sendMessage($queueData);

            return $this->render("upload_files.twig", ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), 'templates' => $templateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response($translator->trans("s3.copyparquet.fail", ["%filename%" => $file_info['name']])." ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * This function will move the file into a trash folder in the mean time but delete the record of it (I think or do we void it?)
     *
     * @Route("/deletefile");
     */
    public function delete(Request $request, FileUploadRepository $fileUploadRepository, TemplateRepository $templateRepository, SqsClient $sqsClient) {
        $shell = $this->getParameter('shell')['fileuploadDelete'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());
        $id = $request->request->get('file');
        $file_info = $fileUploadRepository->find($id)->toArray();
        $uuid = $file_info['uuid'];
        $template_info = $templateRepository->find($file_info['templateid'])->toArray();
        $action = "DeleteFile";

        $params[] = $file_info['name'];
        $params[] = $file_info['folder'];
        $params[] = $file_info['templateid'];
        $params[] = $uuid;
        $params[] = $username;
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        // the trash folder
        $trash_folder = str_replace("data/", "trash/", $file_info['folder']);
        $params[] =  $trash_folder;

        $log_file_name = $username.".".time().".deletefile.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("s3.delete.success", ["%filename%" => $file_info['name']]);
        if ($process->isSuccessful()) {
            $message = ['action' => $action,
                'fileName' => $file_info['name'],
                'templateid' => $template_info['id'],
                'templatename' => $template_info['name'],
                'templateuuid' => $template_info['uuid'],
                'templatepath' => $template_info['bucketinput'],
                'new_folder' => $trash_folder,
                'tablename' => $template_info['tablename'],
                'format' => $template_info['format']
            ];

            $actionArray['s3'] = $action;
            $queueData = $this->buildQueueData("s3", json_encode($message), $this->getUser(), $uuid);
            $sqsClient->sendMessage($queueData);

            return $this->render("upload_files.twig", ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), 'templates' => $templateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response($translator->trans("s3.delete.fail", ["%filename%" => $file_info['name']])." ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
    /**
     * This function will move the file from a trash folder back to the original file
     *
     * @Route("/restorefile");
     */
    public function restore(Request $request, FileUploadRepository $fileUploadRepository, TemplateRepository $templateRepository, SqsClient $sqsClient) {
        $shell = $this->getParameter('shell')['fileuploadRestore'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());
        $id = $request->request->get('file');
        $file_info = $fileUploadRepository->find($id)->toArray();
        $uuid = $file_info['uuid'];
        $template_info = $templateRepository->find($file_info['templateid'])->toArray();
        $action = "RestoreFile";

        $params[] = $file_info['name'];
        $params[] = $file_info['folder'];
        $params[] = $file_info['templateid'];
        $params[] = $uuid;
        $params[] = $username;
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        // the trash folder
        $trash_folder = str_replace("trash/", "data/", $file_info['folder']);
        $params[] =  $trash_folder;

        $log_file_name = $username.".".time().".restore.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("s3.restore.success", ["%filename%" => $file_info['name']]);
        if ($process->isSuccessful()) {
            $message = ['action' => $action,
                'fileName' => $file_info['name'],
                'templateid' => $template_info['id'],
                'templatename' => $template_info['name'],
                'templateuuid' => $template_info['uuid'],
                'templatepath' => $template_info['bucketinput'],
                'new_folder' => $trash_folder,
                'tablename' => $template_info['tablename'],
                'format' => $template_info['format']
            ];

            $actionArray['s3'] = $action;
            $queueData = $this->buildQueueData("s3", json_encode($message), $this->getUser(), $uuid);
            $sqsClient->sendMessage($queueData);

            return $this->render("upload_files.twig", ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), 'templates' => $templateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response($translator->trans("s3.restore.fail", ["%filename%" => $file_info['name']])." ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }


    /**
     * @Route("/copytosharedfolder");
     */
    public function copyToSharedFolder(Request $request, FileUploadRepository $fileUploadRepository, TemplateRepository $templateRepository, SqsClient $sqsClient) {
        $shell = $this->getParameter('shell')['fileuploadCopyToTemplate'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());
        $id = $request->request->get('file');
        $file_info = $fileUploadRepository->find($id)->toArray();
        $uuid = $this->getUuid();
        $template_info = $templateRepository->find($file_info['templateid'])->toArray();
        $action = "CopyToSharedFolder";
        $sharedfolder_template_directory = "data/".$this->getS3FolderNameForAccount()."/shared/template/".$template_info['name']."/".$template_info['format']."/";

        $params[] = $file_info['name'];
        $params[] = $file_info['folder'];
        $params[] = $file_info['templateid'];
        $params[] = $action;
        $params[] = $file_info['size'];
        $params[] = $file_info['uuid'];
        $params[] = $this->getUser()->getUsername();
        $params[] = $username;
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $sharedfolder_template_directory;
        $params[] = $uuid;
        $params[] = $template_info['format'];

        $log_file_name = $username.".".time().".copytotemplatedirectory.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("s3.copytotemplate.success", ["%filename%" => $file_info['name'], "%templatedirectory%" => $sharedfolder_template_directory]);
        if ($process->isSuccessful()) {
            $message = ['action' => $action,
                'fileName' => $file_info['name'],
                'path' => $sharedfolder_template_directory,
                'templateid' => $template_info['id'],
                'templatename' => $template_info['name'],
                'templateuuid' => $template_info['uuid'],
                'templatepath' => $template_info['bucketinput'],
                'tablename' => $template_info['tablename'],
                'format' => $template_info['format']
            ];

            $actionArray['s3'] = $action;
            $queueData = $this->buildQueueData("s3", json_encode($message), $this->getUser(), $uuid);
            $sqsClient->sendMessage($queueData);

            return $this->render("upload_files.twig", ['files' => $fileUploadRepository->getAllForUser($this->getUser(), $this->getAccountId()), 'templates' => $templateRepository->getAll($this->getAccountId())]);
        } else {
            return new Response($translator->trans("s3.copytotemplate.fail", ["%filename%" => $file_info['name']])." ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }
}