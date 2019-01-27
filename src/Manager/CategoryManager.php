<?php

namespace App\Manager;

use App\Entity\Video;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private  $categoryRepository;
    private $categoryDoctrine;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $this->categoryDoctrine = $em;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryList(){
        return $this->categoryRepository->findAll();
    }

    public function getVideoListOfCategory($published = true){
        $list = array();
        $categories = $this->categoryRepository->findAll();

        foreach( $categories as $key => $category){

            if(isset($list[$category->getName()]) === False){
                $list[$category->getName()] = array();
                $videos = $category->getVideos()->getValues();
            }

            foreach ($videos as $key =>  $video){

                if($video->getPublished() == true && $this->getYoutubeIdVideo($video)){
                    array_push($list[$category->getName()], $video);
                }
                else{
                    array_splice($videos, $key, 1);
                }
            }

        }
        return $list;
    }

    public function getYoutubeIdVideo( Video $video){
        $array_link = explode("/",$video->getUrl());
        if(stristr($array_link[2], 'youtube') === FALSE) {
            return false;
        }

        $video->setIdYoutube($array_link[4]);
        return true;
    }

    public function save(Category $category)
    {
        $this->categoryDoctrine->persist($category);
        $this->categoryDoctrine->flush();
    }
}