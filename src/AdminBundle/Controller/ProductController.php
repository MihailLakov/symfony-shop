<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ShopBundle\Form\ProductType;
use ShopBundle\Entity\Product;
class ProductController extends Controller {

  
     /**
     * @Route("/admin/product/create", name="admin-product-create")    
     * @Security("has_role('ROLE_EDITOR')")     
     * @param Request $request
     * @return Response 
     */
    public function createProductAction(Request $request){
        
        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $image = $product->getImage();        
            if($image instanceof UploadedFile){
                $imageName = md5(uniqid()).'.' . $image->guessExtension();            
                $image->move($this->getParameter('product_images_dir'), $imageName);            
                $product->setImage($imageName);    
            }       
            $em->persist($product);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Product added');
            return $this->redirectToRoute('admin-manage-products');          
        }
        return $this->render('admin/product/add.html.twig', array(
            'addProductForm' => $form->createView()
        ));
    }
    
   
    
    /**
     * @Route("/admin/product/edit/{id}/", name="admin-product-edit")
     * @Security("has_role('ROLE_EDITOR')") 
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editProductAction(Request $request, $id){
        
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        
        if($product == null){
             $this->get('session')->getFlashBag()->set('info', "Product with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        $currentImage = $product->getImage();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request); 
    
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
            $image = $product->getImage();             
            if($image instanceof UploadedFile){                
                $imageName = md5(uniqid()).'.' . $image->guessExtension();            
                $image->move($this->getParameter('product_images_dir'), $imageName);            
                $product->setImage($imageName);                    
            } else{
                $product->setImage($currentImage);
            }
            
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'Product updated');    
            return $this->redirectToRoute('admin-manage-products'); 
        }
        return $this->render('admin/product/edit.html.twig', array(
            'editProductForm' => $form->createView(),
            'product' => $product
        ));
        
        
    }   
    
     /**
     * @Route("/admin/product/delete/{id}/", name="admin-product-delete") 
     * @Security("has_role('ROLE_EDITOR')")
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deleteProductAction(Request $request, $id){
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if($product == null){
             $this->get('session')->getFlashBag()->set('info', "Product with id: $id not found ");
             return $this->redirectToRoute('admin-homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "Product deleted ");
        return $this->redirectToRoute('admin-homepage');
    }
    
    /**
     * @Route("/admin/product/form/{$id}", name="admin-product-edit-form")
     * @Method("GET")   
     * @param Product $product
     * @return Response
     */
    public function editProductFormAction(Product $product)
    {   
        $form = $this->createForm(ProductType::class,$product);
        return $this->render('admin/product/edit-form.html.twig', array(
            'editProductForm' => $form->createView(),
            'product' => $product
        ));
    }
}
