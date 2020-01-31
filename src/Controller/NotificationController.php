<?php
namespace App\Controller;

use App\Entity\Notification;
use App\Helper\Utils;
use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends Controller {

    use Utils;
    /**
     * @Route("/notifications", methods={"GET"})
     */
    public function notifications(Request $request, NotificationRepository $notificationRepository) {
        $notifications = $notificationRepository->getAllNotification($this->getLoggedInUsername($this->getUser()));

        // TODO: display the list of notifications
        return new Response(json_encode($notifications));
    }

    /**
     * @Route("/pushnotification", methods={"POST"})
     */
    public function pushNotification(Request $request, NotificationRepository $notificationRepository) {
        $notification = new Notification();
        $em = $this->getDoctrine()->getManager();
        $notification->setAction($request->request->get('message'));
        $notification->setCategory($request->request->get('category'));
        $notification->setColor($request->request->get('color'));
        $notification->setUser($this->getLoggedInUsername($this->getUser()));
        $notification->setIsread(0);

        $em->persist($notification);
        $em->flush();

        $notifications = $notificationRepository->getAllNotification($this->getLoggedInUsername($this->getUser()));

        // TODO: display the list of notifications
        return new Response(json_encode($notifications));
    }

    /**
     * @Route("/markread")
     */
    public function markRead(Request $request, NotificationRepository $notificationRepository) {
        $id = $request->query->get('id');
        if (is_null($id)) {
            return new Response();
        }

        $notificationRepository->markNotificationRead($id);
        return new Response();
    }


}