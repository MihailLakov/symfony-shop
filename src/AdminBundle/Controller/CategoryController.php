<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\CategoryType;
use ShopBundle\Entity\Category;
class CategoryController extends Controller {

  
     /**
     * @Route("/admin/category/create", name="admin-category-create") 
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
        return $this->render('admin/category/add.html.twig', array(
            'addCategoryForm' => $form->createView()
        ));
    }   
   
    
    /**
     * @Route("/admin/category/edit/{id}/", name="admin-category-edit")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editCategoryAction(Request $request, $id){
        
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if($category == null){
             $this->get('session')->getFlashBag()->set('info', "Category with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
          
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Category updated');      
        }
        return $this->render('admin/category/edit.html.twig', array(
            'editCategoryForm' => $form->createView(),
            'category' => $category
        ));
        
        
    }   
    
     /**
     * @Route("/admin/category/delete/{id}/", name="admin-category-delete")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deleteCategoryAction(Request $request, $id){
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        if($category == null){
             $this->get('session')->getFlashBag()->set('info', "Category with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "Category deleted ");
        return $this->redirectToRoute('admin-homepage');
    }
}
