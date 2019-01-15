<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserManager $userManager)
    {
        $users = $userManager->getAllUser();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/{firstname}", name="userby")
     */
    public function indexById(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        return $this->render('user/oneUser.html.twig', [
            'user' => $user,
        ]);
    }
}
