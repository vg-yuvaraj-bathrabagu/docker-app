<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'MsgPhp\User\Infra\Console\Command\DeleteUserRoleCommand' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/console/Command/Command.php';
include_once $this->targetDirs[3].'/vendor/msgphp/domain/Message/MessageReceivingInterface.php';
include_once $this->targetDirs[3].'/vendor/msgphp/domain/Message/MessageDispatchingTrait.php';
include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Console/Command/UserCommand.php';
include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Console/Command/UserRoleCommand.php';
include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Console/Command/DeleteUserRoleCommand.php';

$this->privates['MsgPhp\\User\\Infra\\Console\\Command\\DeleteUserRoleCommand'] = $instance = new \MsgPhp\User\Infra\Console\Command\DeleteUserRoleCommand(($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\EntityAwareFactory'] ?? $this->getEntityAwareFactoryService()), ($this->privates['MsgPhp\\Domain\\Message\\DomainMessageBus'] ?? $this->load('getDomainMessageBusService.php')), ($this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\UserRepository'] ?? $this->getUserRepositoryService()), ($this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\RoleRepository'] ?? $this->load('getRoleRepositoryService.php')));

$instance->setName('user:role:delete');

return $instance;
