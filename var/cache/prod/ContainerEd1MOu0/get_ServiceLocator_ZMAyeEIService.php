<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.zMAyeEI' shared service.

return $this->privates['.service_locator.zMAyeEI'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['queue' => function () {
    return ($this->privates['aws.sqs'] ?? $this->load('getAws_SqsService.php'));
}, 'tasktemplateRepository' => function (): \App\Repository\TaskTemplateRepository {
    return ($this->privates['App\\Repository\\TaskTemplateRepository'] ?? $this->load('getTaskTemplateRepositoryService.php'));
}]);