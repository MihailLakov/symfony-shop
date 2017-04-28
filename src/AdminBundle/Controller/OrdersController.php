<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Category;
use \ShopBundle\Entity\CustomerOrder;
use \ShopBundle\Entity\OrderProduct;
class OrdersController extends Controller
{
    /**
     * @Route("/admin/orders", name="admin-orders-show")
     * @Security("has_role('ROLE_ADMIN)") 
     */
    public function listOrdersAction(Request $request)
    {
        $orders = $this->getDoctrine()->getRepository(CustomerOrder::class)->findAll();
        return $this->render('admin/manage_orders.html.twig',array(
            'orders' => $orders              
        ));
               
    }
     /**
     * @Route("/admin/orders/single/{orderId}", name="admin-orders-show-single")
     * @Security("has_role('ROLE_ADMIN')") 
     * @param $orderId int
     */
    public function showSingleOrderAction(Request $request,$orderId)
    {
       
        $order = $this->getDoctrine()->getRepository(CustomerOrder::class)->find($orderId);
        $orderProducts = $this->getDoctrine()->getRepository(OrderProduct::class)->findBy(array('order'=>$order));
        return $this->render('admin/orders/order.html.twig',array(
            'order' => $order,
            'orderProducts' =>$orderProducts
        ));
               
    }


}
