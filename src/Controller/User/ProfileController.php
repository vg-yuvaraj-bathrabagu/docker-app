<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Repository\AppUserRepository;
use MsgPhp\User\Infra\Doctrine\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


final class ProfileController extends BaseController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, AppUserRepository $appUserRepository, RoleRepository $roleRepository) {
        $app_user = $appUserRepository->find($this->getUser()->getUsername());
        return $this->render("user/profile.html.twig", ['user'=> $app_user->toArray(),  'roles' => $roleRepository->findAll()]);
    }
}
