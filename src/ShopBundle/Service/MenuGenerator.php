<?php

namespace ShopBundle\Service;
use Doctrine\ORM\EntityManager;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\Brand;
class MenuGenerator {
    
    private $entityManager;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function generateCategoryMenuItems(){
        $categories = $this->entityManager->getRepository(Category::class)->findAll();        
        return $categories;
    }
    public function generateBrandMenuItems(){
        $brand = $this->entityManager->getRepository(Brand::class)->findAll();        
        return $brand;
    }

     
    
}
