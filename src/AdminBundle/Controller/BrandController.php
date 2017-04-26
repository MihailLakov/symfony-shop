<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\BrandType;
use ShopBundle\Entity\Brand;
class BrandController extends Controller {

  
     /**
     * @Route("/admin/brand/create", name="admin-brand-create") 
     * @param Request $request
     * @return Response 
     */
    public function createBrandAction(Request $request){
        
        $brand = new Brand();
        $form = $this->createForm(BrandType::class,$brand);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($brand);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Brand added');
            return $this->redirect($request->getUri());            
        }
        return $this->render('admin/brand/add.html.twig', array(
            'addBrandForm' => $form->createView()
        ));
    }   
   
    
    /**
     * @Route("/admin/brand/edit/{id}/", name="admin-brand-edit")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editBrandAction(Request $request, $id){
        
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);
        if($brand == null){
             $this->get('session')->getFlashBag()->set('info', "Brand with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        
        $form = $this->createForm(BrandType::class,$brand);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();          
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Brand updated');      
        }
        return $this->render('admin/brand/edit.html.twig', array(
            'editBrandForm' => $form->createView(),
            'brand' => $brand
        ));        
    }   
    
     /**
     * @Route("/admin/brand/delete/{id}/", name="admin-brand-delete")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deleteBrandAction(Request $request, $id){
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);
        if($brand == null){
             $this->get('session')->getFlashBag()->set('info', "Brand with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($brand);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "Brand deleted ");
        return $this->redirectToRoute('admin-homepage');
    }
}
