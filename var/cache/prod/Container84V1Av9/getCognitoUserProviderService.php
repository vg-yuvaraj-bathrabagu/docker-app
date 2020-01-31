<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Security\CognitoUserProvider' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/security/Core/User/UserProviderInterface.php';
include_once $this->targetDirs[3].'/src/Security/CognitoUserProvider.php';
include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Security/UserRolesProviderInterface.php';
include_once $this->targetDirs[3].'/src/Security/UserRolesProvider.php';

return $this->privates['App\\Security\\CognitoUserProvider'] = new \App\Security\CognitoUserProvider(($this->privates['App\\Bridge\\AwsCognitoClient'] ?? $this->load('getAwsCognitoClientService.php')), ($this->privates['MsgPhp\\User\\Infra\\Doctrine\\Repository\\UserRepository'] ?? $this->getUserRepositoryService()), ($this->privates['MsgPhp\\Domain\\Infra\\Doctrine\\EntityAwareFactory'] ?? $this->getEntityAwareFactoryService()), new \App\Security\UserRolesProvider());
