<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.1z.nMr2' shared service.

return $this->privates['.service_locator.1z.nMr2'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['queue' => function () {
    return ($this->privates['aws.sqs'] ?? $this->load('getAws_SqsService.php'));
}, 'taskcategoryRepository' => function (): \App\Repository\TaskCategoryRepository {
    return ($this->privates['App\\Repository\\TaskCategoryRepository'] ?? $this->load('getTaskCategoryRepositoryService.php'));
}]);
