<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.89z_4OU' shared service.

return $this->privates['.service_locator.89z_4OU'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['fileUploadRepository' => function (): \App\Repository\FileUploadRepository {
    return ($this->privates['App\\Repository\\FileUploadRepository'] ?? $this->load('getFileUploadRepositoryService.php'));
}, 'templateRepository' => function (): \App\Repository\TemplateRepository {
    return ($this->privates['App\\Repository\\TemplateRepository'] ?? $this->load('getTemplateRepositoryService.php'));
}]);