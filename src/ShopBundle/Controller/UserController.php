<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Form\ChangePasswordType;

class UserController extends Controller {

    /**
     * @Route("/profile", name="user-profile") 
     * @param Request $request
     * @return Response 
     */
    public function userProfileAction(Request $request) {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->getUser();
            $form = $this->createForm(ChangePasswordType::class);
            $form->handleRequest($request);             
            if ($form->isSubmitted() && $form->isValid()) {  
                  $password = $this->get('security.password_encoder')
                  ->encodePassword($user, $form->get('newPassword')->getData());
                  $user->setPassword($password);
                  $em = $this->getDoctrine()->getManager();
                  $em->persist($user);
                  $em->flush();
             }
            return $this->render('user/profile.html.twig', [
                        'user' => $user,
                        'changePassForm' => $form->createView(),
                        'errors' => $form->getErrors()
            ]);
        }
        return $this->redirectToRoute('security-login');
    }

    

}
