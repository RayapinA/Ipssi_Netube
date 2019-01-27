<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Manager\VideoManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends AbstractController
{
    /**
     * @Route("/video", name="video")
     */
    public function index(Request $request, VideoManager $videoManager)
    {
        return $this->render('video/index.html.twig', [
            'videoList' =>  $videoManager->getVideoList(),
        ]);
    }

    /**
     * @Route("/video/add", name="add_video")
     */
    public function add(Request $request, VideoManager $videoManager, LoggerInterface $logger)
    {


        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $video = new Video();
        $form = $this->createForm(VideoType::class,$video);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $videoManager->save($video);

            $this->addFlash(
                'notice',
                'Video Added'
            );

            $logger->info('Video Added. idVideo = '.$video->getId().' title = '.$video->getTitle());
        }

        return $this->render('video/add_video.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/video/show/{id}", name="videoById")
     */
    public function videoById(Request $request, VideoManager $videoManager, Video $video)
    {
        $form = $this->createForm(VideoType::class,$video);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $videoManager->save($video);
        }

        return $this->render('video/show_video.html.twig', [
            "video" => $video
        ]);
    }

    /**
     * @Route("/video/edit/{id}", name="editVideo")
     */
    public function editVideo(Request $request, VideoManager $videoManager,Video $video,  LoggerInterface $logger)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(VideoType::class,$video);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $videoManager->save($video);

            $this->addFlash(
                'notice',
                'Video Edited'
            );

            $logger->info('Video Edited. idVideo = '.$video->getId().' title = '.$video->getTitle());
        }

        return $this->render('video/editVideo.html.twig', [
            'form' => $form->createView(),
            "video" => $video
        ]);
    }
}
