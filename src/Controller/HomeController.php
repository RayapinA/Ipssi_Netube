<?php

namespace App\Controller;

use App\Manager\VideoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(VideoManager $videoManager)
    {
        $videos = $videoManager->getVideoListPublished();
        return $this->render('home/index.html.twig', [
            'videos' => $videos
        ]);
    }
}
