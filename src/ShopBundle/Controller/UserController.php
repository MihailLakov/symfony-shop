<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Entity\User;
use ShopBundle\Form\UserType;
use ShopBundle\Entity\Role;

class UserController extends Controller 
{

    /**
     * @Route("/profile", name="user-profile") 
     * @param Request $request
     * @return Response 
     */
    public function userProfileAction(Request $request) {        
        
        $user = $this->getUser();
        if($user){
            return $this->render('user/profile.html.twig', ['user'=>$user]);
        }
        return $this->redirectToRoute('security-login');
        
    }
    
    /**
     * @Route("/secured")
     * @param Request $request
     */
    public function securedAction(Request $request){
        
        echo 'asd';
        return new Response();
    }
    
   

}
