<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.OqRGJ15' shared service.

return $this->privates['.service_locator.OqRGJ15'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['projectAssignmentRepository' => function (): \App\Repository\ProjectAssignmentRepository {
    return ($this->privates['App\\Repository\\ProjectAssignmentRepository'] ?? $this->load('getProjectAssignmentRepositoryService.php'));
}, 'projectrateRepository' => function (): \App\Repository\ProjectRateRepository {
    return ($this->privates['App\\Repository\\ProjectRateRepository'] ?? $this->load('getProjectRateRepositoryService.php'));
}]);