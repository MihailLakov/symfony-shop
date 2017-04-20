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
            $form = $this->createForm(ChangePasswordType::class, null, array(
                'action' => $this->generateUrl('user-profile-change-password'),
                'method' => 'POST',
                    )
            );

            return $this->render('user/profile.html.twig', [
                        'user' => $user,
                        'changePassForm' => $form->createView()
            ]);
        }
        return $this->redirectToRoute('security-login');
    }

    /**
     * @Route("/password-change", name="user-profile-change-password") 
     * @param Request $request
     * @method 'POST'
     * @return Response 
     */
    public function changePasswordAction(Request $request) {

        $form = $this->createForm(ChangePasswordType::class, null, array(
            'action' => $this->generateUrl('user-profile-change-password'),
            'method' => 'POST',
                )
        );
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($form->get('newPassword')->getData());
            var_dump($user);
            exit();
            /*
              $password = $this->get('security.password_encoder')
              ->encodePassword($user, $form->get('newPassword')->getData());
              $user->setPassword($password);
              $em = $this->getDoctrine()->getManager();
              $em->persist($user);
              $em->flush();
             * 
             */
        }
         return $this->render('user/profile.html.twig', [
                        'user' => $user,
                        'changePassForm' => $form->createView()
            ]);
    }

}
