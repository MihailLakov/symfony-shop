<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CatalogController extends Controller {

    /**
     * @Route("/catalog", name="products-catalog") 
     * @param Request $request
     * @return Response 
     */
    public function showProductsAction(Request $request) {

    
    }
    
     /**
     * @Route("/addproduct", name="add-product") 
     * @param Request $request
     * @return Response 
     */
    public function addProductAction(Request $request){
        
    }
}
