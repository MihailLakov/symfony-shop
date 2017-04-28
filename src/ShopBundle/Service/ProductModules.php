<?php

namespace ShopBundle\Service;
use Doctrine\ORM\EntityManager;
use ShopBundle\Entity\Product;
class ProductModules {
    
    private $entityManager;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function latestProductsAction($limit = 5){
        $repo = $this->entityManager->getRepository(Product::class);
        $result = $repo->findBy(array(),array('id' => 'DESC'),$limit);
        return $result;
    }

     
    
}
