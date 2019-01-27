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

    public function getVideoList()
    {
        return $this->videoRepository->findAll();
    }
    public function getVideoListPublished()
    {
        $videosPublished = $this->videoRepository->FindBy(['published' => 1]);

        foreach ($videosPublished as $key => $video){
            if($this->getYoutubeIdVideo($video) === false){
                array_splice($videosPublished, $key, 1);
            }
        }
        return $videosPublished;
    }

    public function getVideosByUser($id)
    {
        $nbVideo = 0;

        $videos = $this->videoRepository->findAll();
        foreach($videos as $video){
            if($video->getUser()->getId() == $id) {
                $nbVideo++;
            }
        }

        return $nbVideo;
    }

    public function getYoutubeIdVideo( Video $video){
        $array_link = explode("/",$video->getUrl());
        if(stristr($array_link[2], 'youtube') === FALSE) {
            return false;
        }

        $video->setIdYoutube($array_link[4]);
        return true;
    }

    public function save(Video $video)
    {
        $this->videoDoctrine->persist($video);
        $this->videoDoctrine->flush();
    }
}