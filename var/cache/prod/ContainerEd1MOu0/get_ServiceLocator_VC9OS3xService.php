<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.vC9OS3x' shared service.

return $this->privates['.service_locator.vC9OS3x'] = new \Symfony\Component\DependencyInjection\ServiceLocator(['accountRepository' => function (): \App\Repository\AccountRepository {
    return ($this->privates['App\\Repository\\AccountRepository'] ?? $this->load('getAccountRepositoryService.php'));
}]);
