<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.a5iTCPh' shared service.

return $this->privates['.service_locator.a5iTCPh'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['s3Client' => function () {
    return ($this->privates['aws.s3'] ?? $this->load('getAws_S3Service.php'));
}, 'templateRepository' => function (): \App\Repository\TemplateRepository {
    return ($this->privates['App\\Repository\\TemplateRepository'] ?? $this->load('getTemplateRepositoryService.php'));
}]);
