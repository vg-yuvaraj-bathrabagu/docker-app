<?php

declare(strict_types=1);

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', TextType::class, array("label" => "Email Address", "attr" => array("placeholder" => "Enter email address", "data-rule-email" => "true", "data-msg-email" => "Please enter a valid email address")));
        $builder->add('password', PasswordType::class, array("attr" => array("placeholder" =>"Password")));
    }
}
