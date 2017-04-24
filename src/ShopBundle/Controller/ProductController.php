<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use ShopBundle\Form\ProductType;
use ShopBundle\Entity\Product;
class ProductController extends Controller {

  
    
    
    /**
     * @Route("/product/{id}", name="view-product")
     * @param $id int
     */
    public function productAction($id){        
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->render('product/product.html.twig', array('product' => $product));        
    }
}
