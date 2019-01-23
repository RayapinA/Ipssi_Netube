<?php

namespace App\Manager;

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

    public function getVideoListOfCategory(){
        $list = array();
        $categories = $this->categoryRepository->findAll();

        foreach( $categories as $key => $category){

            if(isset($list[$key]))
                $list[$category->getName()] = array();

            $list[$category->getName()] = $category->getVideos()->getValues();
        }

        return $list;
    }

    public function save(Category $category)
    {
        $this->categoryDoctrine->persist($category);
        $this->categoryDoctrine->flush();
    }
}