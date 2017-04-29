<?php

namespace ShopBundle\Service;

use Doctrine\ORM\EntityManager;
use ShopBundle\Entity\User;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\CustomerOrder;

class StatsGenerator {

    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getTotalNumberOfUsersAction() {

        return $this->entityManager->getRepository(User::class)
                        ->createQueryBuilder('user')
                        ->select('count(user.id)')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function getTotalNumberOfProductsAction() {

        return $this->entityManager->getRepository(Product::class)
                        ->createQueryBuilder('p')
                        ->select('count(p.id)')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function getTotalNumberOfCategoriesAction() {

        return $this->entityManager->getRepository(Category::class)
                        ->createQueryBuilder('c')
                        ->select('count(c.id)')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function getTotalNumberOfOrdersAction() {

        return $this->entityManager->getRepository(CustomerOrder::class)
                        ->createQueryBuilder('o')
                        ->select('count(o.id)')
                        ->getQuery()
                        ->getSingleScalarResult();
    }
    
    public function getTotalNumberOfBrandsAction() {

        return $this->entityManager->getRepository(CustomerOrder::class)
                        ->createQueryBuilder('o')
                        ->select('count(o.id)')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

}
