<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'MsgPhp\User\Command\Handler\DeleteUserHandler' shared autowired service.

include_once $this->targetDirs[3].'/vendor/msgphp/domain/Message/MessageDispatchingTrait.php';
include_once $this->targetDirs[3].'/vendor/msgphp/user/Command/Handler/DeleteUserHandler.php';

return $this->privates['MsgPhp\\User\\Command\\Handler\\DeleteUserHandler'] = new \MsgPhp\User\Command\Handler\DeleteUserHandler(($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\EntityAwareFactory'] ?? $this->getEntityAwareFactoryService()), ($this->privates['MsgPhp\\Domain\\Message\\DomainMessageBus'] ?? $this->load('getDomainMessageBusService.php')), ($this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\UserRepository'] ?? $this->getUserRepositoryService()));
