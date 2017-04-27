<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\PromotionType;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Promotion;
class PromotionController extends Controller {

  
     /**
     * @Route("/admin/promotion/create", name="admin-promotion-create") 
     * @param Request $request
     * @return Response 
     */
    public function createPromotionAction(Request $request){
        
        $promotion = new Promotion();
        $form = $this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Promotion added');
            return $this->redirect($request->getUri());            
        }
        return $this->render('admin/promotion/add.html.twig', array(
            'addPromotionForm' => $form->createView()
        ));
    }   
   
    
    /**
     * @Route("/admin/promotion/edit/{id}/", name="admin-promotion-edit")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editPromotionAction(Request $request, $id){
        
        $promotion = $this->getDoctrine()->getRepository(Promotion::class)->find($id);
        if($promotion == null){
             $this->get('session')->getFlashBag()->set('info', "Promotion with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        
        $form = $this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
          
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Promotion updated');      
        }
        return $this->render('admin/promotion/edit.html.twig', array(
            'editPromotionForm' => $form->createView(),
            'promotion' => $promotion
        ));
        
        
    }   
    
     /**
     * @Route("/admin/promotion/delete/{id}/", name="admin-promotion-delete")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deletePromotionAction(Request $request, $id){
        $promotion = $this->getDoctrine()->getRepository(Promotion::class)->find($id);
        if($promotion == null){
             $this->get('session')->getFlashBag()->set('info', "Promotion with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($promotion);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "Promotion deleted ");
        return $this->redirectToRoute('admin-homepage');
    }
}
