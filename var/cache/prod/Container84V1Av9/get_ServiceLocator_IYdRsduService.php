<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.IYdRsdu' shared service.

return $this->privates['.service_locator.IYdRsdu'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['mppStatusRepository' => function (): \App\Repository\MPPStatusRepository {
    return ($this->privates['App\\Repository\\MPPStatusRepository'] ?? $this->load('getMPPStatusRepositoryService.php'));
}]);
