<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\ProductType;
use ShopBundle\Entity\Product;
class ProductController extends Controller {

  
     /**
     * @Route("/product/create", name="create-product") 
     * @param Request $request
     * @return Response 
     */
    public function createProductAction(Request $request){
        
        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Product added');
            return $this->redirect($request->getUri());            
        }
        return $this->render('product/add.html.twig', array(
            'addProductForm' => $form->createView()
        ));
    }
    
    /**
     * @Route("/product/{id}", name="view-product")
     * @param $id int
     */
    public function productAction($id){        
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->render('product/product.html.twig', array('product' => $product));        
    }
    
    /**
     * @Route("/product/edit/{id}/", name="edit-product")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editProductAction(Request $request, $id){
        
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if($product == null){
             $this->get('session')->getFlashBag()->set('info', "Product with id: $id not found ");
             return $this->redirectToRoute('homepage');
        }
        
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
          
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Product updated');      
        }
        return $this->render('product/edit.html.twig', array(
            'editProductForm' => $form->createView(),
            'product' => $product
        ));
        
        
    }   
    
     /**
     * @Route("/product/delete/{id}/", name="delete-product")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deleteProductAction(Request $request, $id){
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if($product == null){
             $this->get('session')->getFlashBag()->set('info', "Product with id: $id not found ");
             return $this->redirectToRoute('homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "Product deleted ");
        return $this->redirectToRoute('homepage');
    }
}
