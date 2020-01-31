<?php
/**
 * Project Rates  
 */

namespace App\Controller;

use App\Entity\ProjectRate;
use App\Form\ProjectRateType;
use App\Helper\Utils;
use App\Repository\ProjectAssignmentRepository;
use App\Repository\ProjectRateRepository;
use Aws\Sqs\SqsClient;
use PHPUnit\Runner\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectRateController extends BaseController {

    use Utils;

    /**
     * @Route("/projectrate", name="projectrate")
     */
    public function projectrate(Request $request, ProjectRateRepository $projectrateRepository) {
        $projectrate = new ProjectRate();
        return $this->render('projectrate.twig', ['projectrates' => $projectrateRepository->getAll($this->getAccountId()), "projectrate" => $projectrate->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(ProjectRateType::class, new ProjectRate(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/newprojectrate")
     */
    public function new(Request $request, ProjectRateRepository $projectrateRepository, ProjectAssignmentRepository $projectAssignmentRepository) {
        $projectrate = new ProjectRate();
        return $this->render('projectrate_form.twig', [ "projectrate" => $projectrate->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(ProjectRateType::class, new ProjectRate(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/projectrate/refresh")
     */
    public function refresh(ProjectRateRepository $projectrateRepository) {
        $projectrate = new ProjectRate();
        return $this->render('projectrate_table.twig', ['projectrates' => $projectrateRepository->getAll($this->getAccountId()), "projectrate" => $projectrate->toArray(), 'form' => $this->createForm(ProjectRateType::class, new ProjectRate(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/editprojectrate", methods={"GET"})
     */
    public function edit(Request $request) {
        $projectrate = $this->getDoctrine()->getRepository(ProjectRate::class)->find($request->query->get("id"));

        return $this->render("projectrate_form.twig", ['projectrate'=> $projectrate->toArray(), 'form' => $this->createForm(ProjectRateType::class, $projectrate, array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/viewprojectrate", methods={"GET"})
     */
    public function view(Request $request, ProjectRateRepository $projectrateRepository) {
        $projectrate = $projectrateRepository->find($request->query->get("id"));

        return $this->render("projectrate_view.twig", ['projectrate'=> $projectrate->toArray()]);
    }

    /**
     * @Route("/createprojectrate", methods={"POST"})
     */
    public function create(Request$request, ProjectRateRepository $projectrateRepository, SqsClient $queue) {

        $projectrate = new ProjectRate();
        $projectrate->setAccount($this->getAccount());
        $errorMessage = "";

        $data = $request->get("project_rate");
        $id = $data['id'];
        $action = "creating";

        if (!empty($id)) {
            $projectrate = $projectrateRepository->find($id);
            $action = "updating";
        }

        $form = $this->createForm(ProjectRateType::class, $projectrate, array('account' => $this->getAccountId()));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($projectrate);
                $em->flush();

                $sqs_data_array = $projectrate->toArray();

                // send the SQS message
                $queueData = $this->buildQueueData("projectrate", json_encode(array_merge(['message' => "Project Rate created successfully "], $this->getArrayWithoutNumericKeys($sqs_data_array))), $this->getUser(), $projectrate->getUuid());
                $queue->sendMessage($queueData);

                return $this->render("projectrate_table.twig", ['projectrates'=> $projectrateRepository->getAll($this->getAccountId())]);
            } catch(DBALException $e){
                $errorMessage = $e->getMessage();
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
            }
        } else {
            $errorMessage = $form->getErrors();
        }

        return new Response("Error ".$action." Project Rate ".$errorMessage, 500);

    }

    /**
     * @Route("/deleteprojectrate", methods={"GET"})
     */
    public function delete(Request $request, ProjectRateRepository $projectrateRepository, SqsClient $queue) {
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response("There is no specified id for the project rate to delete", 500);
        }

        $projectrate = $projectrateRepository->find($id);

        if (empty($projectrate)) {
            return new Response("There is no project rate with the specified id to delete", 500);
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectrate);
            $em->flush();

            $sqs_data_array = $projectrate->toArray();

            // send the SQS message
            $queueData = $this->buildQueueData("projectrate", json_encode(array_merge(['message' => "Project Rate deleted successfully "], $this->getArrayWithoutNumericKeys($sqs_data_array))), $this->getUser(), $projectrate->getUuid());
            $queue->sendMessage($queueData);

            return $this->render("projectrate_table.twig", ['projectrates'=> $projectrateRepository->getAll($this->getAccountId())]);

        } catch (Exception $e) {
            return new Response("Error deleting the Project Rate ".$e->getMessage(), 500);
        }
    }
}