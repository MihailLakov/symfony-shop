<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Entity\Product;
class CatalogController extends Controller {

    /**
     * @Route("/catalog", name="products-catalog") 
     * @param Request $request
     * @return Response 
     */
    public function showProductsAction(Request $request) {
        
        $repo = $this->getDoctrine()->getRepository(Product::class);        
        $products = $repo->findAllPublishedProductsWithStock();
        
        return $this->render('catalog/products.html.twig', array(
            'products'=>$products
        ));    
    }
    
  
}
