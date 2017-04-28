<?php

namespace ShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use ShopBundle\Entity\Product;
use ShopBundle\Entity\Review;
use ShopBundle\Form\ReviewType;

class ReviewController extends Controller
{
    
    /**
     * @Route("/product/{id}/reviews/add", name="leave-review-form")
     * @Method("GET")   
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function leaveReviewFormAction(Product $product)
    {
        return $this->render('review/leave_review.html.twig', [
            'reviewForm' => $this->createForm(ReviewType::class)->createView(),
            'product' => $product
        ]);
    }
    /**
     * @Route("/product/{id}/reviews/add", name="leave-review-process")
     * @Method("POST")     
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function leaveReviewProcess(Product $product, Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setProduct($product);
            $review->setDateAdded( new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();
            $this->addFlash("info", "Review added");
            return $this->redirectToRoute('view-product', ['id' => $product->getId()]);
        }
        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }
}
