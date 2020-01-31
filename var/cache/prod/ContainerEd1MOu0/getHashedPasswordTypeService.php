<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'MsgPhp\User\Infra\Form\Type\HashedPasswordType' shared autowired service.

include_once $this->targetDirs[3].'/vendor/symfony/form/FormTypeInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/form/AbstractType.php';
include_once $this->targetDirs[3].'/vendor/msgphp/user/Infra/Form/Type/HashedPasswordType.php';

return $this->privates['MsgPhp\\User\\Infra\\Form\\Type\\HashedPasswordType'] = new \MsgPhp\User\Infra\Form\Type\HashedPasswordType(($this->privates['MsgPhp\\User\\Infra\\Security\\PasswordHashing'] ?? $this->load('getPasswordHashingService.php')), ($this->services['security.token_storage'] ?? ($this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())));
