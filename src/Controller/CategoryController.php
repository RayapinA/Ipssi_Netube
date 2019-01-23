<?php

namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Manager\CategoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(CategoryManager $categoryManager)
    {
        $videoOfThisCategory = $categoryManager->getVideoListOfCategory();
        dump($videoOfThisCategory);

        return $this->render('category/index.html.twig', [
            'categoryList' => $categoryManager->getCategoryList(),
        ]);
    }

    /**
     * @Route("/category/add", name="add_category")
     */
    public function add(Request $request, CategoryManager $categoryManager)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $categoryManager->save($category);
        }

        return $this->render('category/add_category.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/show/{id}", name="categoryById")
     */
    public function videoById(Request $request, CategoryManager $categoryManager, Category $category)
    {
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $categoryManager->save($category);
        }

        return $this->render('category/show_category.html.twig', [
            'form' => $form->createView(),
            "category" => $category
        ]);
    }
}
