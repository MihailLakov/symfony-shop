<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\CategoryType;
use ShopBundle\Entity\Category;
class CategoryController extends Controller {

     
    /**
     * @Route("/category/{id}", name="view-category")
     * @param $id int
     */
    public function categoryAction($id){        
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        return $this->render('category/category.html.twig', array('category' => $category));        
    }
}
