<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Entity\CartProduct;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Cart;
use ShopBundle\Entity\OrderProduct;
use ShopBundle\Entity\CustomerOrder;
use ShopBundle\Entity\Status;
class CartController extends Controller {

    /**
     * @Route("/cart/add", name="add-to-cart") 
     * @method({"POST"})
     * @param Request $request
     * @return Response 
     */
    public function addToCartAction(Request $request) {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            $user = $this->getUser();
            $id = $request->request->get('product_id');
            $quantitiy = $request->request->get('product_quantity');
            $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
            if (!$product) {
                $this->get('session')->getFlashBag()->set('error', "No such product");
                return $this->redirectToRoute('products-catalog');
            }
            $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(array('user' => $user->getId()));

            $cartItem = $this->getDoctrine()->getRepository(CartProduct::class)->findOneBy(array('product' => $product->getId()));
            if (!$cartItem) {
                $cartItem = new CartProduct();
            }

            $cartItem->setCart($cart);
            $cartItem->setProduct($product);
            $cartItem->increaseQuantityBy($quantitiy);

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
    public function showCartAction(Request $request) {

        $user = $this->getUser();
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(array('user' => $user->getId()));
        $cartItems = $this->getDoctrine()->getRepository(CartProduct::class)->findBy(array('cart' => $cart->getId()));

        return $this->render('cart/cart.html.twig', array(
                    'cartItems' => $cartItems
        ));
    }

    /**
     * @Route("/cart/update", name="update-cart")
     * @method({"POST"})
     * @param Request $request
     * @return Response 
     */
    public function updateCartAction(Request $request) {        
         if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $id = $request->request->get('product_id');
            $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(array('user' => $user->getId()));
            $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
            $cartItem = $this->getDoctrine()->getRepository(CartProduct::class)->findOneBy(array('product' => $product->getId()));
            $em = $this->getDoctrine()->getManager();
            if ($request->request->get('delete')) {
                $em->remove($cartItem);
                $em->flush();
                $this->get('session')->getFlashBag()->set('info', "Product removed from cart");
                return $this->redirectToRoute('show-cart');
            }     
            $quantitiy = $request->request->get('product_quantity');
            $cartItem->setQuantity($quantitiy);
            $em->flush();
            $this->get('session')->getFlashBag()->set('info', "Cart updated");
            return $this->redirectToRoute('show-cart');
         } 
         return $this->redirectToRoute('security-login');
    }
    
    
    /**
     * @Route("/cart/checkout", name="checkout-cart")
     * @method({"POST"})
     * @param Request $request
     * @return Response 
     */
    public function checkoutAction(Request $request){
         if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
             
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $order = new CustomerOrder();            
            $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(array('user' => $user->getId()));
            $cartItems = $this->getDoctrine()->getRepository(CartProduct::class)->findBy(array('cart' =>$cart));
            $em->persist($order);
            $totalPrice = 0;
            foreach($cartItems as $item){
                $orderProduct=  new OrderProduct();
                $orderProduct->setOrder($order);
                $orderProduct->setPrice($item->getProduct()->getPrice());
                $orderProduct->setQuantity($item->getQuantity());
                $orderProduct->setProduct($item->getProduct());
                $totalPrice +=$item->getProduct()->getPrice();     
                $em->persist($orderProduct);
                $em->remove($item);
            }
            
            $order->setUser($user);
            $order->setTotal($totalPrice);
            $order->setDateCreated(new \DateTime());
            $order->setStatus($this->getDoctrine()->getRepository(Status::class)->findOneBy(array('title' =>'processing')));
           
            $em->flush();
            return $this->redirectToRoute('show-cart');
         } 
         return $this->redirectToRoute('security-login');
    }

}
