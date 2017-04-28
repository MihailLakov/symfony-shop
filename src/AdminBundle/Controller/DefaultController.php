<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Brand;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Promotion;
use ShopBundle\Entity\CustomerOrder;
class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin-homepage")
     * @Security("has_role('ROLE_EDITOR')") 
     */
    public function adminIndexAction()
    {
        return $this->render('admin/index.html.twig');
    }
    
    /**
     * @Route("/admin/products", name="admin-manage-products")
     * @Security("has_role('ROLE_EDITOR')") 
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
     * @Security("has_role('ROLE_EDITOR')") 
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
     * @Security("has_role('ROLE_EDITOR')") 
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
     * @Security("has_role('ROLE_EDITOR')") 
     */
    public function adminManagePromotionsAction()
    {
        $repo = $this->getDoctrine()->getRepository(Promotion::class);        
        $promotions = $repo->findAll();
        
        return $this->render('admin/manage_promotions.html.twig', array(
            'promotions'=>$promotions
        ));    
   
    }
    
    /**
     * @Route("/admin/orders", name="admin-manage-orders")
     * @Security("has_role('ROLE_ADMIN')") 
     */
    public function adminManageOrdersAction()
    {
        $repo = $this->getDoctrine()->getRepository(CustomerOrder::class);        
        $orders = $repo->findAll();
        
        return $this->render('admin/manage_orders.html.twig', array(
            'orders'=>$orders
        ));    
   
    }
}
