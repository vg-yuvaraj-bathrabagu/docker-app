<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.6PfOHK8' shared service.

return $this->privates['.service_locator.6PfOHK8'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['conversionRepository' => function (): \App\Repository\ConversionRepository {
    return ($this->privates['App\\Repository\\ConversionRepository'] ?? $this->load('getConversionRepositoryService.php'));
}]);