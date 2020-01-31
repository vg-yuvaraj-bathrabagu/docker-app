<?php

namespace App\Controller;

use App\Entity\StateGuide;
use App\Form\NexusAnalysisType;
use App\Helper\Utils;
use App\Repository\StateGuideRepository;
use App\Repository\TemplateRepository;
use Aws\Sqs\SqsClient;
use DateTime;
use ParseCsv\Csv;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for the nexus module
 */

class NexusController extends BaseController {

    use Utils;

    /**
     * @Route("/nexusinitalize", name="nexusinitalize")
     */
    function initialize(TemplateRepository $templateRepository) {
        $templates = $templateRepository->getNexusTemplateForAccount($this->getAccountId());
        if (is_null($templates[0])) {
            if ($this->isGranted('ROLE_NEXUS_ADMIN')) {
                return $this->render("nexus_setup.twig", ["message" => "The setup of this module is not complete, please click the button to start the process", "setupcomplete" => false, "showsetuplink" => true]);
            } else {
                return $this->render("nexus_setup.twig", ["message" => "Nexus is not setup please contact your account administrator", "setupcomplete" => false]);
            }
        } else {
            return $this->render('nexus_setup.twig',
                ['message'=> "Setup for ".$this->getAccountNameForLoggedInUser($this->getUser())." has been completed successfully"]);
        }
    }
    /**
     * @Route("/nexusanalysis", name="nexusanalysis")
     */
    function analysis(TemplateRepository $templateRepository, AdapterInterface $cache) {
        $templates = $templateRepository->getNexusTemplateForAccount($this->getAccountId());
        if (is_null($templates[0])) {
           return $this->redirectToRoute("nexusinitalize");
        }

        $dates = array('startdate' => array(), 'enddate' => array());
        // only cache results when there is no error
        $cache_results = false;
        $cachedDates = $cache->getItem($this->getNexusDateListCacheKey());

        $tablename = $templates[0]['tablename'];

        if ($cachedDates->isHit()) {
            $dates = $cachedDates->get();
        } else {
            $username = $this->getLoggedInUsername($this->getUser());
            $shell = $this->getParameter('shell')['getNexusAnalysisDates'];

            $query_replacements = array('#table_name#' => $tablename);

            $params['tablename'] = $tablename;
            $params['querystring'] = strtr($this->getParameter('nexus.dropdowndates.query'), $query_replacements);
            $params['output'] = $templates[0]['bucketoutput'];
            $params[] = $this->getParameter('s3.region');
            $params[] = $this->getParameter('s3_bucket');
            $params[] = $this->getParameter('s3.presignduration');
            $params[] = $this->getLoggedInUsername($this->getUser());
            $params[] = $this->getAccountId();
            $log_file_name = $username . "." . time() . "nexus-analysis.log";
            $params['logfilename'] = $log_file_name;
            $params[] = $this->getParameter('athena_database');
            $params[] = $this->getParameter('athena_output');
            $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);

            $process = $this->getShellScriptProcess($shell, $params, $log_file_name);
            $process->run();

            if ($process->isSuccessful()) {
                // only load data from a file which exists - this changes each time so is a form of validation that data is not corrupted
                if (file_exists($this->getShellScriptLogFileAbsolutePath($log_file_name) . ".csv")) {
                    $csv_data = new Csv($this->getShellScriptLogFileAbsolutePath($log_file_name) . ".csv");
                    # ignore the first row which is a header row
                    $csv_data->offset = 1;

                    foreach ($csv_data->data as $value) {
                        $start_date_format = DateTime::createFromFormat('Y-m-d', $value['startdate']);
                        $dates['startdate'][$start_date_format->format("m/d/Y")] = $value['startdate'];
                        $end_date_format = DateTime::createFromFormat('Y-m-d', $value['enddate']);
                        $dates['enddate'][$end_date_format->format("m/d/Y")] = $value['enddate'];
                    }
                    // only cache results when the execution is sucessful
                    // write the dates to the cache
                    $cachedDates->set($dates);
                    $cache->save($cachedDates);
                }
            }
        }

        return $this->render("nexus_analysis.twig", ['form' => $this->createForm(NexusAnalysisType::class, null, array('account' => $this->getAccountId(), 'startdate' => $dates['startdate'], 'enddate' => $dates['enddate']))->createView(), "setupcomplete" => true, "tablename" => $tablename, "output" => $templates[0]['bucketoutput']]);

    }

    /**
     * @Route("/dataprofile", name="dataprofile")
     */
    function dataprofile(TemplateRepository $templateRepository, AdapterInterface $cache) {
        $templates = $templateRepository->getNexusTemplateForAccount($this->getAccountId());
        if (is_null($templates[0])) {
            return $this->redirectToRoute("nexusinitalize");
        }
        $dates = array('startdate' => array(), 'enddate' => array());
        $cachedDates = $cache->getItem($this->getNexusDateListCacheKey());

        $tablename =$templates[0]['tablename'];

        if ($cachedDates->isHit()) {
            $dates = $cachedDates->get();
        } else {
            $username = $this->getLoggedInUsername($this->getUser());
            $shell = $this->getParameter('shell')['getNexusAnalysisDates'];

            $query_replacements = array('#table_name#' => $tablename);

            $params['tablename'] = $tablename;
            $params['querystring'] = strtr($this->getParameter('nexus.dropdowndates.query'), $query_replacements);
            $params['output'] = $templates[0]['bucketoutput'];
            $params[] = $this->getParameter('s3.region');
            $params[] = $this->getParameter('s3_bucket');
            $params[] = $this->getParameter('s3.presignduration');
            $params[] = $this->getLoggedInUsername($this->getUser());
            $params[] = $this->getAccountId();
            $log_file_name = $username.".".time()."nexus-analysis.log";
            $params['logfilename'] = $log_file_name;
            $params[] = $this->getParameter('athena_database');
            $params[] = $this->getParameter('athena_output');
            $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);

            $process =  $this->getShellScriptProcess($shell, $params, $log_file_name);
            $process->run();

            if ($process->isSuccessful()) {
                if (file_exists($this->getShellScriptLogFileAbsolutePath($log_file_name) . ".csv")) {
                    $csv_data = new Csv($this->getShellScriptLogFileAbsolutePath($log_file_name) . ".csv");
                    # ignore the first row which is a header row
                    $csv_data->offset = 1;

                    foreach ($csv_data->data as $value) {
                        $start_date_format = DateTime::createFromFormat('Y-m-d', $value['startdate']);
                        $dates['startdate'][$start_date_format->format("m/d/Y")] = $value['startdate'];
                        $end_date_format = DateTime::createFromFormat('Y-m-d', $value['enddate']);
                        $dates['enddate'][$end_date_format->format("m/d/Y")] = $value['enddate'];
                    }
                    // only cache results when the execution is sucessful
                    // write the dates to the cache
                    $cachedDates->set($dates);
                    $cache->save($cachedDates);
                }
            }
        }

        return $this->render("nexus_data_profile.twig", ['form' => $this->createForm(NexusAnalysisType::class, null, array('account' => $this->getAccountId(), 'startdate' => $dates['startdate'], 'enddate' => $dates['enddate']))->createView(), "setupcomplete" => true, "tablename" => $tablename, "output" => $templates[0]['bucketoutput']]);
    }


    /**
     * @Route("/runanalysis", name="runanalysis")
     */
    function runanalysis(Request $request, SqsClient $queue, StateGuideRepository $stateGuideRepository) {
        $username = $this->getLoggedInUsername($this->getUser());
        $shell = $this->getParameter('shell')['runNexusAnalysisFile'];

        $tablename = $request->request->get("tablename");

        $state_filter_string = "";
        $date_filter = array();
        $analysisdetail = "";

        if (!empty($request->request->get("state"))) {
            $state_filter_string = " AND s.id = ".$request->request->get("state")." ";
            $analysisdetail.= "-".$stateGuideRepository->getStateName($request->request->get("state"));
        }
        if (!empty($request->request->get("startdate"))) {
            $date_filter[] = " date_parse(n.documentdate, '%m/%d/%Y') >= date('".$request->request->get("startdate")."') ";
            $analysisdetail.= "-from-".$request->request->get("startdate");
        }
        if (!empty($request->request->get("enddate"))) {
            $date_filter[] = " date_parse(n.documentdate, '%m/%d/%Y') <= date('".$request->request->get("enddate")."') ";
            $analysisdetail.= "-to-".$request->request->get("enddate");
        }

        $date_filter_string = "";
        if (count($date_filter) > 0) {
            $date_filter_string = " WHERE ".join($date_filter, " AND ");
        }

        $query_replacements = array("#table_name#" => $tablename, "#state_filter_string#" => $state_filter_string, "#date_filter_string#" => $date_filter_string);

        $params['tablename'] = $tablename;
        $params['querystring'] = strtr($this->getParameter('nexus.analysis.query'), $query_replacements);
        $params['output'] = $request->request->get("output");
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = $this->getAccountId();
        $log_file_name = $username.".".time()."nexus-analysis.log";
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);

        $process =  $this->getShellScriptProcess($shell, $params, $log_file_name);
        $process->run();
        if ($process->isSuccessful()) {
            $presign_url = file_get_contents($this->getShellScriptLogFileAbsolutePath($log_file_name.".presign_url"));
            $queueData = $this->buildQueueData("nexus", json_encode(array_merge(['presign_url_output' => $presign_url, 'message' => "Nexus Analysis Completed"], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), time());
            $queue->sendMessage($queueData);

            return $this->render("nexus_analysis_output.twig", ["results" => json_decode(file_get_contents($this->getShellScriptLogFileAbsolutePath($log_file_name.".athena")), true), 'output_file' => $log_file_name.".csv", "analysisdetail" => $analysisdetail]);
        } else {
            return new Response("Error carrying out analysis ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/rundataprofile", name="rundataprofile")
     */
    function rundataprofile(Request $request, SqsClient $queue, StateGuideRepository $stateGuideRepository) {
        $username = $this->getLoggedInUsername($this->getUser());
        $shell = $this->getParameter('shell')['runNexusDataPreviewFile'];

        $tablename = $request->request->get("tablename");

        $filter = array();
        $dataprofilefilenamedetail = "";

        if (!empty($request->request->get("state"))) {
            $filter[] = " state = (SELECT s.state FROM stateguide s WHERE s.id = ".$request->request->get("state").") ";
            $dataprofilefilenamedetail.= "-".$stateGuideRepository->getStateName($request->request->get("state"));
        }
        if (!empty($request->request->get("startdate"))) {
            $filter[] = " date_parse(documentdate, '%m/%d/%Y') >= date('".$request->request->get("startdate")."') ";
            $dataprofilefilenamedetail.= "-from-".$request->request->get("startdate");
        }
        if (!empty($request->request->get("enddate"))) {
            $filter[] = " date_parse(documentdate, '%m/%d/%Y') <= date('".$request->request->get("enddate")."') ";
            $dataprofilefilenamedetail.= "-to-".$request->request->get("enddate");
        }

        $filter_string = "";
        if (count($filter) > 0) {
            $filter_string = " WHERE ".join($filter, " AND ");
        }

        $query_replacements = array("#table_name#" => $tablename, "#filter_string#" => $filter_string);

        $params['tablename'] = $tablename;
        $params['querystring'] = strtr($this->getParameter('nexus.dataprofile.query'), $query_replacements);
        $params['output'] = $request->request->get("output");
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = $this->getAccountId();
        $log_file_name = $username.".".time()."nexus-dataprofile.log";
        $params['logfilename'] = $log_file_name;
        $params[] = $this->getParameter('athena_database');
        $params[] = $this->getParameter('athena_output');
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);

        $process =  $this->getShellScriptProcess($shell, $params, $log_file_name);
        $process->run();
        if ($process->isSuccessful()) {
            $presign_url = file_get_contents($this->getShellScriptLogFileAbsolutePath($log_file_name.".presign_url"));
            $queueData = $this->buildQueueData("nexus", json_encode(array_merge(['presign_url_output' => $presign_url, 'message' => "Nexus Data Preview"], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), time());
            $queue->sendMessage($queueData);

            return $this->render("nexus_data_profile_output.twig", ["results" => json_decode(file_get_contents($this->getShellScriptLogFileAbsolutePath($log_file_name.".athena")), true), 'output_file' => $log_file_name.".csv", "dataprofiledetail" => $dataprofilefilenamedetail]);
        } else {
            return new Response("Error previewing data ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/nexusreport", name="nexusreport")
     */
    function report() {
        return $this->render("nexus_report.twig", ['account' => $this->getAccount()->toArray()]);
    }

    /**
     * @Route("/nexusmetadata", name="nexusmetadata")
     */
    function metadata(StateGuideRepository $stateGuideRepository) {
        return $this->render("state_guide.twig", ['stateguides' => $stateGuideRepository->getAll($this->getAccountId())]);
    }

    /**
     * @Route("/viewnexusmetadata", methods={"GET"})
     */
    public function view(Request $request) {
        $stateguide = $this->getDoctrine()->getRepository(StateGuide::class)->find($request->query->get("id"));

        return $this->render("state_guide_view.twig", ['stateguide'=> $stateguide->toArray()]);
    }

    /**
     * @Route("/nexusfileupload", name="nexusfileupload")
     */
    function upload(TemplateRepository $templateRepository) {
        $templates = $templateRepository->getNexusTemplateForAccount($this->getAccountId());
        if (is_null($templates[0])) {
            return $this->redirectToRoute("nexusinitalize");
        } else {
            return $this->render("upload.twig", ['templates' => $templateRepository->getNexusTemplateForAccount($this->getAccountId()), "show_blank_template" => false, "show_status" => false, "show_trash" => false]);
        }
    }

    /**
     *
     * Copied from TemplateController#createTemplate as it provides the same functionality. The difference here is that the contents of the request are hard coded
     * @param Request $request
     * @param TemplateRepository $templateRepository
     * @param SqsClient $queue
     * @return Response
     *
     * @Route("/nexussetup", name="nexussetup")
     */
    public function setup(Request $request, TemplateRepository $templateRepository, SqsClient $queue) {


        $data = Array
        (
            "name" => "Nexus",
            "format" => "Text",
        "delimiter" => ",",
            "tablename" => "nexus".$this->getAccountId(),
        "type" => "Core",
        "samplerow" => $this->getParameter("nexus.template.samplerow"),
            "id" =>"",
            "rules" => $this->getParameter("nexus.template.rules")
        );

        foreach ($data as $key => $value) {
            $request->request->set($key, $value);
        }


        $translator = $this->get('translator');
        $id = $request->request->get('id');

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

            return $this->render('nexus_setup.twig',
                ['message'=> "Setup for ".$this->getAccountNameForLoggedInUser($this->getUser())." has been completed successfully"]);
        } else {
            return $this->render('nexus_setup.twig',
                ['error' => true, 'message'=> "Error creating Nexus Template ".$this->getShellScriptLogFileContents($log_file_name)]);

        }
    }


}