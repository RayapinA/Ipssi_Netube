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
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $users = $userManager->getAllUser();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/{firstname}", name="userby")
     */
    public function indexById(Request $request, User $user,UserManager $userManager)
    {

        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $userManager->save($user);
        }

        return $this->render('user/oneUser.html.twig', [
            'user' => $user,
        ]);
    }


    /**
     * @Route("/user/edit/{firstname}", name="editUserBy")
     */
    public function EditById(Request $request, User $user,UserManager $userManager)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $emailUser = $user->getEmail();
        $currentUser = $this->getUser()->getEmail();
        $currentRoles = $this->getUser()->getRoles();

//TODO BUG a COrriger
        //if( ($emailUser != $currentUser) === False || in_array("ROLE_ADMIN",$currentRoles) === False) {
            //Echo " Vous pouvez pas faire cela";
            //return $this->redirectToRoute("home");
            //exit();
        //}
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $userManager->save($user);

            $this->addFlash(
                'notice',
                'Video Edited'
            );
        }

        return $this->render('user/editUser.html.twig', [

            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
