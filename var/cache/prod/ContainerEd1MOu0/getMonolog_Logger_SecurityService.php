<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'monolog.logger.security' shared service.

$this->privates['monolog.logger.security'] = $instance = new \Symfony\Bridge\Monolog\Logger('security');

$instance->pushHandler(($this->privates['cloudwatch_handler'] ?? $this->getCloudwatchHandlerService()));
$instance->pushHandler(($this->privates['monolog.handler.console'] ?? ($this->privates['monolog.handler.console'] = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, []))));
$instance->pushHandler(($this->privates['monolog.handler.container_logs'] ?? $this->getMonolog_Handler_ContainerLogsService()));
$instance->pushHandler(($this->privates['monolog.handler.main'] ?? $this->getMonolog_Handler_MainService()));

return $instance;
