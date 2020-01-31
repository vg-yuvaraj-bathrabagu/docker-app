<?php


namespace App\EventListener;

use App\Helper\Utils;
use App\Repository\AppUserRepository;
use Aws\Sqs\SqsClient;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    use Utils;

    private $queue;
    private $userRepository;
    private $container;

    public function __construct(SqsClient $queue, AppUserRepository $userRepository, ContainerInterface $container)
    {
        $this->queue = $queue;
        $this->userRepository = $userRepository;
        $this->container = $container;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        // Get the User entity.
        $security_user = $event->getAuthenticationToken()->getUser();
        $appUser = $this->userRepository->findOneBy(array("id" => $security_user->getUsername()));
        $request = $event->getRequest();

        $queueData = $this->buildQueueData("login", json_encode(['message' => "Successful User Login", 'host' => $request->headers->get('host'), 'amazon-trace-id' => $request->headers->get('x-amzn-trace-id')]), $security_user, $appUser->getUuid());
        $this->queue->sendMessage($queueData);
    }

    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @throws \LogicException If DoctrineBundle is not available
     *
     * @final
     */
    protected function getDoctrine(): ManagerRegistry
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application. Try running "composer require symfony/orm-pack".');
        }

        return $this->container->get('doctrine');
    }

    /**
     * Gets a container configuration parameter by its name.
     *
     * @return mixed
     *
     * @final
     */
    protected function getParameter(string $name)
    {
        return $this->container->getParameter($name);
    }
}