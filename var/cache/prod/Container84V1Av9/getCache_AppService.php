<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'cache.app' shared service.

$this->services['cache.app'] = $instance = new \Symfony\Component\Cache\Adapter\FilesystemAdapter('Vm4hA+QIU9', 0, ($this->targetDirs[0].'/pools'));

$instance->setLogger(($this->privates['monolog.logger.cache'] ?? $this->getMonolog_Logger_CacheService()));

return $instance;
