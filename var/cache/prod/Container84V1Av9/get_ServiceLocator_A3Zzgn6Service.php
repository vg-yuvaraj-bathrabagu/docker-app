<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.a3Zzgn6' shared service.

return $this->privates['.service_locator.a3Zzgn6'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['taskRepository' => function (): \App\Repository\TaskRepository {
    return ($this->privates['App\\Repository\\TaskRepository'] ?? $this->load('getTaskRepositoryService.php'));
}]);
