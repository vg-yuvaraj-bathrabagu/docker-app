<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Form\User\LoginType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

/**
 * @Route("/login", name="login")
 */
final class LoginController
{
    public function __invoke(
        Environment $twig,
        FormFactoryInterface $formFactory,
        AuthenticationUtils $authenticationUtils,
        ContainerInterface $container
    ): Response {
        $form = $formFactory->createNamed('', LoginType::class, [
            'email' => $authenticationUtils->getLastUsername(),
        ]);

        if (null !== $error = $authenticationUtils->getLastAuthenticationError(true)) {
            $form->addError(new FormError("Invalid Credentials", $error->getMessageKey(), $error->getMessageData()));
        }

        if ($container->getParameter('need_update') =='yes') {
            // forward to the installer
            return new RedirectResponse("install");
        }

        return new Response($twig->render('user/login.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
