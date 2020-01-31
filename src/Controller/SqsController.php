<?php
namespace App\Controller;

use App\Helper\Utils;
use Aws\Sqs\SqsClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SqsController extends Controller {

    use Utils;
    /**
     * @Route("/sqs", methods={"GET"})
     */
    public function sqs() {
        return $this->render("sqs.twig");
    }
    /**
     * @Route("/sqslist")
     */
    public function viewSQS(SqsClient $queue) {
        $queue->setQueueAttributes(array(
            'Attributes' => [
                'ReceiveMessageWaitTimeSeconds' => 20
            ],
            'QueueUrl' => $this->getParameter('sqs_notificationQueue'), // REQUIRED
        ));
        $result = $queue->receiveMessage([
            'MaxNumberOfMessages' => 10,
            'QueueUrl' => $this->getParameter('sqs_notificationQueue'), // REQUIRED
            'MessageAttributeNames' => ['All'],
            'WaitTimeSeconds' => 20,
        ]);

        return $this->render("sqslist.twig", ['messages'=> $result->getPath('Messages')]);
    }
}