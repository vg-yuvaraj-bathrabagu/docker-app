<?php
/**
 * Controller for Simulations
 */

namespace App\Controller;

use App\Entity\Simulation;
use App\Helper\Utils;
use App\Repository\SimulationRepository;
use Aws\Sqs\SqsClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimulationController extends BaseController {

    use Utils;

    /**
     * @Route("/model", name="model")
     */
    public function simulator(SimulationRepository $simulationRepository) {
        $simulation = new Simulation();
        return $this->render("simulator.twig", ["simulations"=> $simulationRepository->getAll($this->getAccountId()), "simulation" => $simulation->toArray()]);
    }

    /**
     * @Route("/model/refresh")
     */
    public function refresh(SimulationRepository $simulationRepository) {
        $simulation = new Simulation();
        return $this->render("simulator_table.twig",['simulations'=> $simulationRepository->getAll($this->getAccountId()), "simulation" => $simulation->toArray()]);
    }
    /**
     * @Route("/createmodel", methods={"POST"})
     */
    public function create(Request$request, SimulationRepository $simulationRepository, SqsClient $queue) {
        $translator = $this->get('translator');
        $id = $request->request->get('id');
        $uuid = '';
        $username = $this->getLoggedInUsername($this->getUser());

        $message_code = "create";
        if (empty($id)) {
            $shell = $this->getParameter('shell')['simulationCreateFile'];
        } else {
            $shell = $this->getParameter('shell')['simulationUpdateFile'];
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
            $uuid = $simulationRepository->getUuidFromId($id);
            $params[] = $uuid;
        }

        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $params[] = $this->getParameter('s3.presignduration');
        $params[] = $this->getLoggedInUsername($this->getUser());
        $params[] = $this->getAccountId();
        $log_file_name = $username.".".time().".".$message_code."simulation.".$uuid.".log";

        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params['s3outputfolder'] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."simulation/";
        $params['logfilename'] = $log_file_name;

        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("simulation.".$message_code.".success", ["%category%" => $type]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("simulation", json_encode(array_merge(['message' => $message, 'Model' => $type], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("simulator_table.twig", ['simulations'=> $simulationRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("simulation.".$message_code.".fail", ["%category%" => $type]);
            return new Response("Error creating Model ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/editmodel", methods={"GET"})
     */
    public function edit(Request $request) {
        $simulation = $this->getDoctrine()->getRepository(Simulation::class)->find($request->query->get("id"));

        return $this->render("simulator_form.twig", ['simulation'=> $simulation->toArray()]);
    }
    /**
     * @Route("/viewmodel", methods={"GET"})
     */
    public function view(Request $request) {
        $simulation = $this->getDoctrine()->getRepository(Simulation::class)->find($request->query->get("id"));

        return $this->render("simulator_view.twig", ['simulation'=> $simulation->toArray()]);
    }

    /**
     * @Route("/deletemodel", methods={"GET"})
     */
    public function delete(Request $request, SimulationRepository $simulationRepository, SqsClient $queue) {
        $shell = $this->getParameter('shell')['simulationDeleteFile'];
        $translator = $this->get('translator');
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            throw new \Exception($translator->trans("simulation.delete.noid"));
        }

        $params[] = $id;
        $uuid = $simulationRepository->getUuidFromId($id);
        $params[] = $uuid;
        $params[] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."simulation/";
        $params[] = $this->getParameter('s3.region');
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".deletesimulation.".$uuid.".log";
        $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        $process->run();

        $message = $translator->trans("simulation.delete.success", ['%category%' => $id]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("simulation", json_encode(['message' => $message, 'Model' => $id, 's3outputfolder' => $this->getPathToS3UploadFolderForUserAction($this->getUser())."simulation/", 'logfilename' => $log_file_name]), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            return $this->render("simulator_table.twig", ['simulations'=> $simulationRepository->getAll($this->getAccountId())]);
        } else {
            $message = $translator->trans("simulation.create.fail", ['%category%' => $id]);
            return new Response("Error deleting the Model ".$this->getShellScriptLogFileContents($log_file_name), 500);
        }
    }

    /**
     * @Route("/runmodel", methods={"GET"})
     */
    public function run(Request $request, SimulationRepository $simulationRepository, SqsClient $queue, LoggerInterface $logger) {
        $shell = $this->getParameter('shell')['simulationRunFile'];
        $translator = $this->get('translator');
        $username = $this->getLoggedInUsername($this->getUser());

        $id = $request->query->get('id');
        $simulation = $simulationRepository->find($id);
        $values = $simulation->toArray();
        $uuid = $values['uuid'];
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
        $params[] = $this->getParameter('s3_bucket');
        $log_file_name = $username.".".time().".runsimulation.".$uuid.".log";
        $params[] = $this->getShellScriptLogFileAbsolutePath($log_file_name);
        $params['s3outputfolder'] = $this->getPathToS3UploadFolderForUserAction($this->getUser())."simulation/";
        $params[] = $this->getParameter('s3.presignduration');
        $params['logfilename'] = $log_file_name;

        $type = $request->query->get('type');

        if ($type == 'background') {
            $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name, true);
        } else {
            // run as foreground task
            $process =  $this->getDatabaseShellScriptProcess($shell, $params, $log_file_name);
        }

        $logger->info("Starting simulation with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $process->run();
        $logger->info("Completed simulation with uuid ".$uuid." at ".$this->getFormattedTimeStamp());
        $logger->debug("Output of simulation with uuid  ".$uuid." is ".$process->getOutput());

        $message = $translator->trans("simulation.run.success", ["%category%" => $values['category']]);
        if ($process->isSuccessful()) {
            $queueData = $this->buildQueueData("simulation", json_encode(array_merge(['message' => $message, 'Model' => $id], $this->getArrayWithoutNumericKeys($params))), $this->getUser(), $uuid);
            $queue->sendMessage($queueData);

            if ($type == 'background') {
                return $this->render("simulator_table.twig", ['simulations'=> $simulationRepository->getAll($this->getAccountId())]);
            } else {

                return $this->render("simulator_results.twig", ['output' => $this->getShellScriptLogFileContents($log_file_name)]);
            }
        } else {
            $message = $translator->trans("simulation.run.fail", ["%category%" => $values['category']]);
            return $this->render("simulator_results.twig", ['error'=> $this->getShellScriptLogFileContents($log_file_name)]);
        }

        
    }

}