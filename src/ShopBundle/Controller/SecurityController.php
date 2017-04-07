<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ShopBundle\Entity\User;
use ShopBundle\Form\UserType;
use ShopBundle\Entity\Role;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="security-login") 
     * @return Response 
     */
    public function loginAction(Request $request) {

        return $this->render('security/login.html.twig');
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
        if ($form->isSubmitted()) {
            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $roleRepo = $this->getDoctrine()->getRepository(Role::class);
            $userRole = $roleRepo->findOneBy(['name' => 'ROLE_USER']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('security-login');
        }

        return $this->render('security/register.html.twig');
    }

}
