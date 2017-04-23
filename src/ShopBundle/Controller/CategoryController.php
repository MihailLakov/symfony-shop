<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\CategoryType;
use ShopBundle\Entity\Category;
class CategoryController extends Controller {

  
     /**
     * @Route("/category/create", name="create-category") 
     * @param Request $request
     * @return Response 
     */
    public function createCategoryAction(Request $request){
        
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Category added');
            return $this->redirect($request->getUri());            
        }
        return $this->render('category/add.html.twig', array(
            'addCategoryForm' => $form->createView()
        ));
    }
    
    /**
     * @Route("/category/{id}", name="view-category")
     * @param $id int
     */
    public function categoryAction($id){        
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        return $this->render('category/category.html.twig', array('category' => $category));        
    }
    
    /**
     * @Route("/category/edit/{id}/", name="edit-category")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editCategoryAction(Request $request, $id){
        
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if($category == null){
             $this->get('session')->getFlashBag()->set('info', "Category with id: $id not found ");
             return $this->redirectToRoute('homepage');
        }
        
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
          
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Category updated');      
        }
        return $this->render('category/edit.html.twig', array(
            'editCategoryForm' => $form->createView(),
            'category' => $category
        ));
        
        
    }   
    
     /**
     * @Route("/category/delete/{id}/", name="delete-category")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deleteCategoryAction(Request $request, $id){
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if($category == null){
             $this->get('session')->getFlashBag()->set('info', "Category with id: $id not found ");
             return $this->redirectToRoute('homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "Category deleted ");
        return $this->redirectToRoute('homepage');
    }
}
