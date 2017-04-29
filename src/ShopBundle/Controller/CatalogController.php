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
    
    /**
     * @Route("/catalog/category/{id}", name="catalog-view-category") 
     * @param Request $request, int $id
     * @return Response 
     */
    public function showProductsByCategoryAction(Request $request, $id){
        $repo = $this->getDoctrine()->getRepository(Product::class);        
        $products = $repo->findAllProductsFromCategory($id);
        
        return $this->render('catalog/category.html.twig', array(
            'products'=>$products                
        )); 
    }
    
    /**
     * @Route("/catalog/brand/{id}", name="catalog-view-brand") 
     * @param Request $request, int $id
     * @return Response 
     */
    public function showProductsByBrandAction(Request $request, $id){
        $repo = $this->getDoctrine()->getRepository(Product::class);        
        $products = $repo->findAllProductsFromBrand($id);
        
        return $this->render('catalog/brand.html.twig', array(
            'products'=>$products                
        )); 
    }
    
  
}
