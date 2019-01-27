<?php

namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Manager\CategoryManager;
use Psr\Log\LoggerInterface;
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

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $videoOfThisCategory = $categoryManager->getVideoListOfCategory();


        return $this->render('category/index.html.twig', [
            'categoryList' => $categoryManager->getCategoryList(),
        ]);
    }

    /**
     * @Route("/category/add", name="add_category")
     */
    public function add(Request $request, CategoryManager $categoryManager, LoggerInterface $logger)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $categoryManager->save($category);
            $this->addFlash(
                'notice',
                'Video Added'
            );

            $logger->info('Category Added. idCategory = '.$category->getId().' title = '.$category->getTitle());
        }

        return $this->render('category/add_category.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/category/show/{id}", name="categoryById")
     */
    public function categoryById( CategoryManager $categoryManager, Category $category)
    {

        $videos = $categoryManager->getVideoListOfCategory();
        $videoOfThisCategory = $videos[$category->getName()];


        return $this->render('category/show_category.html.twig', [
            "category" => $category,
            "videos" => $videoOfThisCategory
        ]);
    }


    /**
     * @Route("/category/edit/{id}", name="editCategoryById")
     */
    public function editCategoryById(Request $request, CategoryManager $categoryManager, Category $category,LoggerInterface $logger)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $categoryManager->save($category);

            $logger->info('Category Added. idCategory = '.$category->getId().' title = '.$category->getTitle());
        }

        return $this->render('category/editCategory.html.twig', [
            'form' => $form->createView(),
            "category" => $category
        ]);
    }
}
