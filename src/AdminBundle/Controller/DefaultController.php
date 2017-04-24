<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShopBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin-homepage")
     * 
     */
    public function adminIndexAction()
    {
        return $this->render('admin/index.html.twig');
    }
    
    /**
     * @Route("/admin/products", name="admin-manage-products")
     * 
     */
    public function adminManageProducts()
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);        
        $products = $repo->findAll();
        
        return $this->render('admin/manage_products.html.twig', array(
            'products'=>$products
        ));    
   
    }
}
