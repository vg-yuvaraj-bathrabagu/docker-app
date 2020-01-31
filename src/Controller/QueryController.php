<?php
/**
 * Controller for Queries
 */

namespace App\Controller;

use App\Entity\CustomReport;
use App\Form\QueryType;
use App\Helper\Utils;
use App\Repository\CustomReportRepository;
use Aws\Sqs\SqsClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QueryController extends BaseController {

    use Utils;

    /**
     * @Route("/queries", name="queries")
     */
    public function queries(CustomReportRepository $customReportRepository) {
        $query = new CustomReport();
        return $this->render("query.twig",['customReports'=> $customReportRepository->getAll($this->getUser(), $this->getAccountId()), "query" => $query->toArray(), 'form' => $this->createForm(QueryType::class)->createView()]);
    }

    /**
     * @Route("/queries/refresh")
     */
    public function refresh(CustomReportRepository $customReportRepository) {
        $query = new CustomReport();
        return $this->render("query_table.twig",['customReports'=> $customReportRepository->getAll($this->getUser(), $this->getAccountId()), "query" => $query->toArray(), 'form' => $this->createForm(QueryType::class)->createView()]);
    }
    /**
     * @Route("/createquery", methods={"POST"})
     */
    public function createQuery(Request$request, CustomReportRepository $customReportRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['queryCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['queryUpdateFile'];
            $message_code = "update";
        }

        $params['title'] = $request->request->get('title');
        $category = $request->request->get('category');
        $params['category'] = $category;
        $params['description'] = $request->request->get('description');
        $params['querystring'] = $request->request->get('querystring');
        if (empty($id)) {
            // then its a create hence uuid
            $uuid = $this->getUuid();
            $params[] = $uuid;
        } else {
            $params[] = $id;
            $uuid = $customReportRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params['type'] = $request->request->get('type');
        $params[] = $this->getAccountId();
        $log_file_name = $username.".".time().".".$message_code."query.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params['s3outputfolder'] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."query/";
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getUser()->getUsername();

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("query.".$message_code.".success", ["%category%" => $category]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("query", json_encode(array_merge(['message' => $message, 'Query' => $category], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("query_table.twig", ['customReports'=> $customReportRepository->getAll($this->getUser(), $this->getAccountId()), 'form' => $this->createForm(QueryType::class)->createView()]);
        } else {
            $message = $translator->trans("query.".$message_code.".fail", ["%category%" => $category]);
            return new Response("Error creating Query ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/editquery", methods={"GET"})
     */
    public function edit(Request $request) {
        $query = $this->getDoctrine()->getRepository(CustomReport::class)->find($request->query->get("id"));

        return $this->render("query_form.twig", ['query'=> $query->toArray(), 'form' => $this->createForm(QueryType::class)->createView()]);
    }
    /**
     * @Route("/viewquery", methods={"GET"})
     */
    public function view(Request $request) {
        $query = $this->getDoctrine()->getRepository(CustomReport::class)->find($request->query->get("id"));

        return $this->render("query_view.twig", ['query'=> $query->toArray(), 'form' => $this->createForm(QueryType::class)->createView()]);
    }

    /**
     * @Route("/deletequery", methods={"GET"})
     */
    public function delete(Request $request, CustomReportRepository $customReportRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['queryDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            throw new \Exception($translator->trans("query.delete.noid"));
        }

        $params[] = $id;
        $uuid = $customReportRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."query/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');

        $log_file_name = $username.".".time().".deletequery.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("query.delete.success", ['%category%' => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("query", json_encode(['message' => $message, 'Query' => $id, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."query/", 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("query_table.twig", ['customReports'=> $customReportRepository->getAll($this->getUser(), $this->getAccountId()), 'form' => $this->createForm(QueryType::class)->createView()]);
        } else {
            $message = $translator->trans("query.delete.fail", ['%category%' => $id]);
            return new Response("Error deleting the Query ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }


    }

    /**
     * @Route("/runquery", methods={"GET"})
     */
    public function run(Request $request, CustomReportRepository $customReportRepository, SqsClient $queue, LoggerInterface $logger) {

        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());

        $id = $request->query->get('id');
        $new_customReport = $customReportRepository->find($id);
        $values = $new_customReport->toArray();
        $uuid = $values['uuid'];

        $shell = $this->getParameter('shell')['queryRunFile'];

        $params[] = $id;
        $params['title'] = $values['title'];
        $params['category'] = $values['category'];
        $params['bucket'] = $values['bucket'];
        $params['description'] = $values['description'];
        $params['querystring'] = $values['querystring'];
        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $params[] = $uuid;
        $params[] = $this->getParameter('s3.region');
        $log_file_name = $username.".".time().".runquery.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params['s3outputfolder'] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."query/";
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = str_replace("input", "output", $values['bucket']);
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getUser()->getUsername();

        $type = $request->query->get('type');
        if ($type == 'background') {
            $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name, true);
        } else {
            // run as foreground task
            $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        }


        $logger->info("Starting shell run of query with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed run of shell query with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of shell query with uuid  ".$uuid." is ".$process->getOutput());

        $message = $translator->trans("query.run.success", ["%category%" => $values['category']]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("query", json_encode(array_merge(['message' => $message, 'Query' => $id], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            if ($type == 'background') {
                return $this->render("query_table.twig", ['customReports'=> $customReportRepository->getAll($this->getUser(), $this->getAccountId())]);
            } else {
                $data = [];
                // clear the repository cache to reload the updated entity
                $customReportRepository->clear();
                $new_customReport = $customReportRepository->find($id);
                $new_values = $new_customReport->toArray();
                if (strtolower($values['category']) == "athena") {

                    $data["athenaoutput"] = $new_values['athenaoutput'];
                }

                $data['logs'] = $new_values['statusresult'];
                return $this->render("query_results.twig", $data);
            }
        } else {
            $message = $translator->trans("query.run.fail", ["%category%" => $values['category']]);
            return $this->render("query_results.twig", ['error'=> $this->getShellScriptLogFileContents($log_file_name)]);
        }

    }
}