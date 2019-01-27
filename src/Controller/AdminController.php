<?php

namespace App\Controller;

use App\Manager\CategoryManager;
use App\Manager\UserManager;
use App\Manager\VideoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(VideoManager $videoManager,UserManager $userManager,CategoryManager $categoryManager)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $users = $userManager->getAllUser();
        $categories = $categoryManager->getCategoryList();
        $videos = $videoManager->getVideoList();

        return $this->render('admin/index.html.twig', [
            "users" => $users,
            "categories" => $categories,
            "videos" => $videos
        ]);
    }
}
