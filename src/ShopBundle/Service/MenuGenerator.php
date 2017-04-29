<?php

namespace ShopBundle\Service;
use Doctrine\ORM\EntityManager;
use ShopBundle\Entity\Category;
class MenuGenerator {
    
    private $entityManager;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function generateCategoryMenuItems(){
        $categories = $this->entityManager->getRepository(Category::class)->findAll();        
        return $categories;
    }

     
    
}
