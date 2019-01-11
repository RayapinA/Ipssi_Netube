<?php

namespace App\Manager;

use App\Repository\VideoRepository;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;

class VideoManager
{

    private $videoRepository;
    private $videoDoctrine;

    public function __construct(VideoRepository $videoRepository, EntityManagerInterface $em)
    {
        $this->videoDoctrine = $em;
        $this->videoRepository = $videoRepository;
    }

    public function getVideoList(){
        return $this->videoRepository->findAll();
    }

    public function save(Video $video)
    {
        $this->videoDoctrine->persist($video);
        $this->videoDoctrine->flush();
    }
}