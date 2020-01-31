<?php
/**
 * Tasks 
 */

namespace App\Controller;

use App\Entity\TaskCategory;
use App\Form\TaskCategoryType;
use App\Helper\Utils;
use App\Repository\ProjectAssignmentRepository;
use App\Repository\TaskCategoryRepository;
use Aws\Sqs\SqsClient;
use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use PHPUnit\Runner\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskCategoryController extends BaseController {

    use Utils;

    /**
     * @Route("/taskcategory", name="taskcategory")
     */
    public function taskcategory(Request $request, TaskCategoryRepository $taskcategoryRepository) {
        $taskcategory = new TaskCategory();
        return $this->render('taskcategory.twig', ['taskcategories' => $taskcategoryRepository->getAll($this->getAccountId()), "taskcategory" => $taskcategory->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(TaskCategoryType::class, new TaskCategory(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/newtaskcategory")
     */
    public function new(Request $request, TaskCategoryRepository $taskcategoryRepository, ProjectAssignmentRepository $projectAssignmentRepository) {
        $taskcategory = new TaskCategory();
        return $this->render('taskcategory_form.twig', [ "taskcategory" => $taskcategory->toArray(), 'userid' => $this->getUserId(), 'form' => $this->createForm(TaskCategoryType::class, new TaskCategory(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/taskcategory/refresh")
     */
    public function refresh(TaskCategoryRepository $taskcategoryRepository) {
        $taskcategory = new TaskCategory();
        return $this->render('taskcategory_table.twig', ['taskcategories' => $taskcategoryRepository->getAll($this->getAccountId()), "taskcategory" => $taskcategory->toArray(), 'form' => $this->createForm(TaskCategoryType::class, new TaskCategory(), array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/edittaskcategory", methods={"GET"})
     */
    public function edit(Request $request) {
        $taskcategory = $this->getDoctrine()->getRepository(TaskCategory::class)->find($request->query->get("id"));

        return $this->render("taskcategory_form.twig", ['taskcategory'=> $taskcategory->toArray(), 'form' => $this->createForm(TaskCategoryType::class, $taskcategory, array('account' => $this->getAccountId()))->createView()]);
    }

    /**
     * @Route("/viewtaskcategory", methods={"GET"})
     */
    public function view(Request $request, TaskCategoryRepository $taskcategoryRepository) {
        $taskcategory = $taskcategoryRepository->find($request->query->get("id"));

        return $this->render("taskcategory_view.twig", ['taskcategory'=> $taskcategory->toArray()]);
    }

    /**
     * @Route("/createtaskcategory", methods={"POST"})
     */
    public function create(Request$request, TaskCategoryRepository $taskcategoryRepository, SqsClient $queue) {

        $taskcategory = new TaskCategory();
        $taskcategory->setAccount($this->getAccount());
        $errorMessage = "";

        $id = $request->get('task_category')['id'];
        $action = "creating";

        if (!empty($id)) {
            $taskcategory = $taskcategoryRepository->find($id);
            $action = "updating";
        }

        $form = $this->createForm(TaskCategoryType::class, $taskcategory, array('account' => $this->getAccountId()));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($taskcategory);
                $em->flush();

                $sqs_data_array = $taskcategory->toArray();

                // send the SQS message
                $queueData = $this->buildQueueData("taskcategory", json_encode(array_merge(['message' => "Task Category created successfully "], $this->getArrayWithoutNumericKeys($sqs_data_array))), $this->getUser(), $taskcategory->getUuid());
                $queue->sendMessage($queueData);

                return $this->render("taskcategory_table.twig", ['taskcategories'=> $taskcategoryRepository->getAll($this->getAccountId())]);
            } catch(DBALException $e){
                $errorMessage = $e->getMessage();
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
            }
        } else {
            $errorMessage = $form->getErrors();
        }

        return new Response("Error ".$action." Task Category ".$errorMessage, 500);

    }

    /**
     * @Route("/deletetaskcategory", methods={"GET"})
     */
    public function delete(Request $request, TaskCategoryRepository $taskcategoryRepository, SqsClient $queue) {
        $id = $request->query->get('id');
        $username = $this->getLoggedInUsername($this->getUser());

        if (empty($id)) {
            return new Response("There is no specified id for the task category to delete", 500);
        }

        $taskcategory = $taskcategoryRepository->find($id);

        if (empty($taskcategory)) {
            return new Response("There is no task category with the specified id to delete", 500);
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($taskcategory);
            $em->flush();

            $sqs_data_array = $taskcategory->toArray();

            // send the SQS message
            $queueData = $this->buildQueueData("taskcategory", json_encode(array_merge(['message' => "Task Category deleted successfully "], $this->getArrayWithoutNumericKeys($sqs_data_array))), $this->getUser(), $taskcategory->getUuid());
            $queue->sendMessage($queueData);

            return $this->render("taskcategory_table.twig", ['taskcategories'=> $taskcategoryRepository->getAll($this->getAccountId())]);

        } catch (Exception $e) {
            return new Response("Error deleting the Task Category ".$e->getMessage(), 500);
        }
    }
}