<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Brand;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Promotion;
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
    public function adminManageProductsAction()
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);        
        $products = $repo->findAll();
        
        return $this->render('admin/manage_products.html.twig', array(
            'products'=>$products
        ));    
   
    }
    
    /**
     * @Route("/admin/categories", name="admin-manage-categories")
     * 
     */
    public function adminManageCategoriesAction()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);        
        $categories = $repo->findAll();
        
        return $this->render('admin/manage_categories.html.twig', array(
            'categories'=>$categories
        ));    
   
    }
    
    /**
     * @Route("/admin/brands", name="admin-manage-brands")
     * 
     */
    public function adminManageBrandsAction()
    {
        $repo = $this->getDoctrine()->getRepository(Brand::class);        
        $brands = $repo->findAll();
        
        return $this->render('admin/manage_brands.html.twig', array(
            'brands'=>$brands
        ));    
   
    }
    
    /**
     * @Route("/admin/promotions", name="admin-manage-promotions")
     */
    public function adminManagePromotionsAction()
    {
        $repo = $this->getDoctrine()->getRepository(Promotion::class);        
        $promotions = $repo->findAll();
        
        return $this->render('admin/manage_promotions.html.twig', array(
            'promotions'=>$promotions
        ));    
   
    }
}
