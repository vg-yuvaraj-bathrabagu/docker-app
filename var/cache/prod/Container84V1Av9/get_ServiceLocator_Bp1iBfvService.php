<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.Bp1iBfv' shared service.

return $this->privates['.service_locator.Bp1iBfv'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['templateRepository' => function (): \App\Repository\TemplateRepository {
    return ($this->privates['App\\Repository\\TemplateRepository'] ?? $this->load('getTemplateRepositoryService.php'));
}]);
