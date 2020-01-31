<?php

declare(strict_types=1);

namespace MsgPhp\User\Command\Handler;

use MsgPhp\Domain\Exception\EntityNotFoundException;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\Domain\Message\{DomainMessageBusInterface, MessageDispatchingTrait};
use MsgPhp\User\Command\DeleteUserCommand;
use MsgPhp\User\Entity\User;
use MsgPhp\User\Event\UserDeletedEvent;
use MsgPhp\User\Repository\UserRepositoryInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class DeleteUserHandler
{
    use MessageDispatchingTrait;

    private $repository;

    public function __construct(EntityAwareFactoryInterface $factory, DomainMessageBusInterface $bus, UserRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        try {
            $user = $this->repository->find($this->factory->identify(User::class, $command->userId));
        } catch (EntityNotFoundException $e) {
            return;
        }

        $this->repository->delete($user);
        $this->dispatch(UserDeletedEvent::class, [$user]);
    }
}
