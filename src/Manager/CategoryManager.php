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

    public function save(Category $category)
    {
        $this->categoryDoctrine->persist($category);
        $this->categoryDoctrine->flush();
    }
}