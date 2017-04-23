<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Entity\User;
use ShopBundle\Form\UserType;
use ShopBundle\Entity\Role;

class SecurityController extends Controller 
{

    /**
     * @Route("/login", name="security-login") 
     * @return Response 
     */
    public function loginAction(Request $request) {
        
        $authenticationUtils = $this->get('security.authentication_utils');        
        $error = $authenticationUtils->getLastAuthenticationError();        
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
   
    }
    
    /**
     * @Route("/logout", name="security-logout")
     * @param Request $request
     * @return Response
     */
    public function logoutAction(Request $request){
        return new Response();
    }
    /**
     * @Route("/register", name="security-register") 
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request) {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);  
            $userRole = $this->getDoctrine()->getRepository(Role::class)->findOneBy(['name' => 'ROLE_USER']);
            $user->addRole($userRole);
            $user->setBalance(100);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('session')->getFlashBag()->set('success', "You have registered an account, please log in!");
            return $this->redirectToRoute('security-login');
        }

        return $this->render('security/register.html.twig',
                ['registerForm' => $form->createView()]
                );
    }
    
    /**
     * 
     * @Route("/error403", name="error403")
     */
    public function unauthorisedAction(){
        return $this->render('security/403.html.twig');
    }

}
