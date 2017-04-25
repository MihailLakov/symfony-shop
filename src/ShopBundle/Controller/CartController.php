<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Entity\CartProduct;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Cart;

class CartController extends Controller {

    /**
     * @Route("/cart/add/{id}", name="add-to-cart") 
     * @param $id int
     * @param Request $request
     * @return Response 
     */
    public function addToCartAction(Request $request,$id) {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            
            $user = $this->getUser();
            
            $product = $this->getDoctrine()->getRepository(Product::class)->find($id);  
            if(!$product){
                $this->get('session')->getFlashBag()->set('error', "No such product");
                return $this->redirectToRoute('products-catalog');
            }
            $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(array('user' => $user->getId()));   
            $cartItem = $this->getDoctrine()->getRepository(CartProduct::class)->findOneBy(array('product' => $product->getId()));
            
            if(!$cartItem){
                $cartItem = new CartProduct();
            } 
            $cartItem->setCartId($cart->getId());
            $cartItem->setProduct($product->getId());
            $cartItem->increaseQuantityBy(1);
    
            $em = $this->getDoctrine()->getManager();
            $em->persist($cartItem);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', "Product - " . $product->getTitle() . " has been added");
            return $this->redirectToRoute('products-catalog');
        }
        return $this->redirectToRoute('security-login');
    }
    
    /**
     * @Route("/user/cart" ,name="show-cart")
     * 
     */
    public function showCartAction(){
         $user = $this->getUser();
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(array('user' => $user->getId()));  
        $cartItems = $this->getDoctrine()->getRepository(CartProduct::class)->findBy(array('cartId' => $cart->getId()));
        
        
        return $this->render('cart/cart.html.twig', array(
            'cartItems' => $cartItems
        ));
    }
    
  

    

}
