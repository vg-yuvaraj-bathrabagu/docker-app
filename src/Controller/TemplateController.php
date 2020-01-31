<?php
namespace App\Controller;

use App\Entity\Template;
use App\Form\TemplateType;
use App\Helper\Utils;
use App\Repository\TemplateRepository;
use Aws\Sqs\SqsClient;
use ParseCsv\Csv;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends BaseController {

    use Utils;
    /**
     * @Route("/createtemplate", methods={"POST"})
     */
    public function createTemplate(Request $request, TemplateRepository $templateRepository, SqsClient $queue) {

        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $name = '';

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['templateCreateFile'];

            $uuid = $this->getUuid();
            $name = trim($request->request->get('name'));
            $params[] = $name;

        } else {
            $shell = $this->getParameter('shell')['templateUpdateFile'];

            $uuid = $templateRepository->getUuidFromId($id);
            $params[] = $id;

            $message_code = "update";
        }

        $username = $this->getLoggedInUsername($this->getUser());
        // transform the field values JSON to more standardized JSON
        $rules_json = $this->transformTemplateFieldValuesToJSON($request->request->get('name'), $request->request->get('tablename'), $request->request->get('rules'));
        $log_file_name = $username.".".time().".".$message_code."template.".$uuid.".log";

        $params['format'] = $request->request->get('format');
        $tablename = $request->request->get('tablename');
        $params[] = $tablename;
        $params['delimiter'] = $request->request->get('delimiter');
        $params['samplerow'] = $request->request->get('samplerow');

        $params['mapping'] = $rules_json;
        $params['athenadatabase'] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $params[] = $uuid;
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params['s3outputfolder'] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."template/";
        $params[] = $this->getParameter('s3.presignduration');

        $params[] = $username;
        $params[] = $this->getParameter('s3_bucket');
        // the column definitions
        $params['athenatablecolumndefinition'] = $this->getCommaDelimitedColumnDefinition($rules_json);
        $params['type'] = $request->request->get('type');
        $params[] = $this->getAccountId();
        $params[] = $this->getS3FolderNameForAccount();
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getUser()->getUsername();
        $params['simulationid'] = $request->request->get('simulationid');


        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("template.".$message_code.".success", ["%name%" => $tablename]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("template", json_encode(array_merge(['message' => $message, 'table' => $tablename ], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render('template_table.twig',
                ['templates'=> $templateRepository->getAll($this->getAccountId()),
                    'form' => $this->createForm(TemplateType::class, new Template(), array('account' => $this->getAccountId()))->createView()]) ;
        } else {
            $message = $translator->trans("template.".$message_code.".fail", ["%name%" => $tablename]);
            return new Response("Error creating Template ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/templates", name="templates")
     */
    public function index(TemplateRepository $templateRepository) {
        return $this->render("template.twig",
                ['templates'=> $templateRepository->getAll($this->getAccountId()),
                        'template' => new Template(),
                        'form' => $this->createForm(TemplateType::class, new Template(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/wizard")
     */
    public function wizard(TemplateRepository $templateRepository) {
        return $this->render("template_form_full.twig",
            ['form' => $this->createForm(TemplateType::class, new Template(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/templates/refresh")
     */
    public function refresh(TemplateRepository $templateRepository) {
        return $this->render("template_table.twig",
            ['templates'=> $templateRepository->getAll($this->getAccountId()),
                'form' => $this->createForm(TemplateType::class, new Template(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/edittemplate", methods={"GET"})
     */
    public function edit(Request $request) {
        $template = $this->getDoctrine()->getRepository(Template::class)->find($request->query->get("id"));

        return $this->render("template_form.twig", ['template'=> $template->toArray(), 'form' => $this->createForm(TemplateType::class)->createView()]);
    }
    /**
     * @Route("/blanktemplate", methods={"GET"})
     */
    public function blank(Request $request) {
        $template = new Template();

        return $this->render("template_form.twig", ['template'=> $template->toArray(), 'form' => $this->createForm(TemplateType::class)->createView()]);
    }


    /**
     * @Route("/activatetemplate")
     */
    public function activate(Request $request, TemplateRepository $templateRepository,SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->query->get('id');

        if (empty($id)) {
            return new Response("No template id provided for activating template ", 500);
        }

        $template = $templateRepository->find($id);
        $name = $template->getName();
        $uuid = $template->getUuid();

        // make the template active
        $template->setIsactive(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($template);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $message = $translator->trans("template.activate.success", ["%name%" => $name]);
        $queueData = $this->buildQueueData("template", json_encode(['message' => $message, 'Template' => $name]), $this->getUser(), $uuid);
        $queue->sendMessage($queueData);

        return $this->render("template_table.twig",
            ['templates'=> $templateRepository->getAll($this->getAccountId()),
                'form' => $this->createForm(TemplateType::class, new Template(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/deactivatetemplate")
     */
    public function deactivate(Request $request, TemplateRepository $templateRepository,SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->query->get('id');

        if (empty($id)) {
            return new Response("No template id provided for deactivating template ", 500);
        }

        $template = $templateRepository->find($id);
        $name = $template->getName();
        $uuid = $template->getUuid();

        // make the template active
        $template->setIsactive(0);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($template);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $message = $translator->trans("template.deactivate.success", ["%name%" => $name]);
        $queueData = $this->buildQueueData("template", json_encode(['message' => $message, 'Template' => $name]), $this->getUser(), $uuid);
        $queue->sendMessage($queueData);

        return $this->render("template_table.twig",
            ['templates'=> $templateRepository->getAll($this->getAccountId()),
                'form' => $this->createForm(TemplateType::class, new Template(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/synctemplate", methods={"GET"})
     */
    public function sync(Request $request, TemplateRepository $templateRepository, SqsClient $queue) {

        $shell = $this->getParameter('shell')['templateSyncFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response("No template id provided for syncing template ", 500);
        }

        $params[] = $id;

        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $uuid = $templateRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".synctemplate.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser());
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = $this->getParameter('s3_bucket');

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("template.sync.success", ['%category%' => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("template", json_encode(['message' => $message, 'Template' => $id]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render('template_table.twig',
                ['templates'=> $templateRepository->getAll($this->getAccountId()),
                    'form' => $this->createForm(TemplateType::class)->createView()]) ;
        } else {
            $message = $translator->trans("template.sync.fail", ['%category%' => $id]);
            return new Response("Error syncing template ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }

    }

    /**
     * @Route("/deletetemplate", methods={"GET"})
     */
    public function delete(Request $request, TemplateRepository $templateRepository, SqsClient $queue) {

        $shell = $this->getParameter('shell')['templateDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response("No template id provided for deleting template ", 500);
        }

        $template = $templateRepository->find($id);
        $values = $template->toArray();
        $uuid = $values['uuid'];

        $params[] = $id;
        $params[] = $values['tablename'];
        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $params[] = $this->getParameter('s3.region');
        $params[] = $values['uuid'];
        $log_file_name = $username.".".time().".deletetemplate.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params[] = $values['bucketinput'];
        $params[] = $values['bucketoutput'];
        $params[] = $values['type'];
        // the shared folders only used for Core, replace username with shared
        $params[] = str_replace($username, "shared", $values['bucketinput']);
        $params[] = str_replace($username, "shared",$values['bucketoutput']);

        $uuid = $templateRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getParameter('s3.region');

        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser());
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = $this->getParameter('s3_bucket');

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("template.sync.success", ['%category%' => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("template", json_encode(['message' => $message, 'Query' => $id]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render('template_table.twig',
                ['templates'=> $templateRepository->getAll($this->getAccountId()),
                    'form' => $this->createForm(TemplateType::class)->createView()]) ;
        } else {
            $message = $translator->trans("template.sync.fail", ['%category%' => $id]);
            return new Response("Error syncing template ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }

    }

    /**
     * @Route("/getsamplerow", methods={"POST"})
     */
    function samplerow(Request $request) {
        try {
            $sample_file = $request->files->get('samplefile');
            if ($sample_file->isValid()) {
                try {
                    $csv = new Csv();
                    $csv->limit = 1;
                    $csv->parse($sample_file->getPathname());
                    $sample_data = $csv->data;
                    return new JsonResponse($sample_data);
                } catch (\Exception $e) {
                    return new JsonResponse("Error occured while loading sample row from uploaded file ".$e->getMessage(), 500);
                }

            } else {
                return new Response("Unable to access uploaded file ".$sample_file->getErrorMessage(), 500);
            }
        } catch (\Exception $e) {
            return new Response("Error occured uploading the file ".$e->getMessage(), 500);
        }
    }
}