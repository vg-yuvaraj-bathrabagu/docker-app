<?php
/**
 *
 */

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Helper\Utils;
use App\Repository\ProjectRepository;
use Aws\Sqs\SqsClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends BaseController {

    use Utils;

    /**
     * @Route("/project", name="project")
     */
    public function project(ProjectRepository $projectRepository) {
        $project = new Project();
        return $this->render("project.twig", ['projects' => $projectRepository->getAll($this->getAccountId()), "project" => $project->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(ProjectType::class, new Project(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/newproject")
     */
    public function new() {
        $rate = new Project();
        return $this->render('project_form.twig', [ "project" => $rate->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(ProjectType::class, new Project(), array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/project/refresh")
     */
    public function refresh(ProjectRepository $projectRepository) {
        $project = new Project();
        return $this->render("project_table.twig", ['projects' => $projectRepository->getAll($this->getAccountId()), "project" => $project->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(ProjectType::class, new Project(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/createproject", methods={"POST"})
     */
    public function create(Request$request, ProjectRepository $projectRepository, SqsClient $queue) {
        $project = new Project();
        $project->setAccount($this->getAccount());
        $errorMessage = "";

        $data = $request->get("project");
        $id = $data['id'];
        $action = "creating";

        if (empty($id)) {
            $project->setDatecreated(new \DateTime());
            print_r("The id of the user is ".$this->getUserId());
            $project->setCreatedby($this->getUserId());
        } else {
            $project = $projectRepository->find($id);
            $action = "updating";
        }

        $form = $this->createForm(ProjectType::class, $project, array('account' => $this->getAccountId()));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();

                $sqs_data_array = $project->toArray();

                // send the SQS message
                $queueData = $this->buildQueueData("project", json_encode(array_merge(['message' => "Project created successfully "], $this->getArrayWithoutNumericKeys($sqs_data_array))), $this->getUser(), $project->getUuid());
                $queue->sendMessage($queueData);

                return $this->render("project_table.twig", ['projects'=> $projectRepository->getAll($this->getAccountId())]);
            } catch(DBALException $e){
                $errorMessage = $e->getMessage();
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
            }
        } else {
            $errorMessage = $form->getErrors();
        }

        return new Response("Error ".$action." Project ".$errorMessage, 500);
    }

    /**
     * @Route("/editproject", methods={"GET"})
     */
    public function edit(Request $request) {
        $project = $this->getDoctrine()->getRepository(Project::class)->find($request->query->get("id"));

        return $this->render("project_form.twig", ['project'=> $project->toArray(), 'form' => $this->createForm(ProjectType::class, $project, array('account' => $this->getAccountId()))->createView()]);
    }
    /**
     * @Route("/viewproject", methods={"GET"})
     */
    public function view(Request $request) {
        $project = $this->getDoctrine()->getRepository(Project::class)->find($request->query->get("id"));

        return $this->render("project_view.twig", ['project'=> $project->toArray()]);
    }


    /**
     * @Route("/deleteproject", methods={"GET"})
     */
    public function delete(Request $request, ProjectRepository $projectRepository, SqsClient $queue) {
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response("There is no specified id for the project rate to delete", 500);
        }

        $project = $projectRepository->find($id);

        if (empty($project)) {
            return new Response("There is no project with the specified id to delete", 500);
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();

            $sqs_data_array = $project->toArray();

            // send the SQS message
            $queueData = $this->buildQueueData("project", json_encode(array_merge(['message' => "Project deleted successfully "], $this->getArrayWithoutNumericKeys($sqs_data_array))), $this->getUser(), $project->getUuid());
            $queue->sendMessage($queueData);

            return $this->render("project_table.twig", ['projects'=> $projectRepository->getAll($this->getAccountId())]);

        } catch (Exception $e) {
            return new Response("Error deleting the Project ".$e->getMessage(), 500);
        }
    }

}