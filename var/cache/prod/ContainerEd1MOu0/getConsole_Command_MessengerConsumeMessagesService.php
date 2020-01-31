<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'console.command.messenger_consume_messages' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/console/Command/Command.php';
include_once $this->targetDirs[3].'/vendor/symfony/messenger/Command/ConsumeMessagesCommand.php';

$this->privates['console.command.messenger_consume_messages'] = $instance = new \Symfony\Component\Messenger\Command\ConsumeMessagesCommand(($this->services['message_bus'] ?? $this->load('getMessageBusService.php')), new \Symfony\Component\DependencyInjection\ServiceLocator([]), ($this->privates['monolog.logger'] ?? $this->getMonolog_LoggerService()), []);

$instance->setName('messenger:consume-messages');

return $instance;
