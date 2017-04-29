<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\UserType;
use ShopBundle\Form\UserEditType;
use ShopBundle\Entity\User;
use ShopBundle\Entity\Cart;
use ShopBundle\Entity\CartProduct;
use ShopBundle\Entity\CustomerOrder;
use ShopBundle\Entity\OrderProduct;
class UserController extends Controller {

    /**
     * @Route("/admin/user/create", name="admin-user-create")
     * @Security("has_role('ROLE_ADMIN')") 
     * @param Request $request
     * @return Response 
     */
    public function createUserAction(Request $request) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'User added');
            return $this->redirect($request->getUri());
        }
        return $this->render('admin/user/add.html.twig', array(
                    'addUserForm' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/user/edit/{id}/", name="admin-user-edit")
     * @Security("has_role('ROLE_ADMIN')") 
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function editUserAction(Request $request, $id) {

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if ($user == null) {
            $this->get('session')->getFlashBag()->set('info', "User with id: $id not found ");
            return $this->redirectToRoute('admin-homepage');
        }
        $cart = $this->getDoctrine()->getRepository(Cart::class)->findOneBy(['user' => $user]);
        $cartProducts = $this->getDoctrine()->getRepository(CartProduct::class)->findBy(['cart' => $cart]);
        $customerOrders = $this->getDoctrine()->getRepository(CustomerOrder::class)->findBy(['user' => $user]);
        $orderProducts = array();
        foreach($customerOrders as $order){
            $orderProducts = $this->getDoctrine()->getRepository(OrderProduct::class)->findBy(['order' => $order]);
        }
        
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', 'User updated');
        }
        return $this->render('admin/user/edit.html.twig', array(
                    'editUserForm' => $form->createView(),
                    'user' => $user,
                    'cartProducts' => $cartProducts,
                    'orders' =>$customerOrders,
                    'orderProducts' =>$orderProducts
        ));
    }

    /**
     * @Route("/admin/user/delete/{id}/", name="admin-user-delete")
     * @Security("has_role('ROLE_ADMIN')") 
     * @param $request Request
     * @param $id int
     * @return Response
     */
    public function deleteUserAction(Request $request, $id) {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if ($user == null) {
            $this->get('session')->getFlashBag()->set('info', "User with id: $id not found ");
            return $this->redirectToRoute('admin-homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->set('success', "User deleted ");
        return $this->redirectToRoute('admin-homepage');
    }

}
