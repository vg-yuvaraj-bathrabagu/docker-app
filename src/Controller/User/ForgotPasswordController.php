<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Form\User\ForgotPasswordType;
use MsgPhp\User\Command\RequestUserPasswordCommand;
use MsgPhp\User\Repository\UserRepositoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Twig\Environment;


final class ForgotPasswordController
{
    public function __invoke(
        Request $request,
        FormFactoryInterface $formFactory,
        FlashBagInterface $flashBag,
        Environment $twig,
        MessageBusInterface $bus,
        UserRepositoryInterface $repository
    ): Response {
        $form = $formFactory->createNamed('', ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->getData()['nickname'];
            $bus->dispatch(new RequestUserPasswordCommand($repository->findByUsername($username)->getId()));
            $flashBag->add('reset_password_success', sprintf('Hi %s, a password reset link has been sent to your email address.  Please follow the instructions to reset your password.', $username));

            return new RedirectResponse('/login');
        }

        return new Response($twig->render('user/forgot_password.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
