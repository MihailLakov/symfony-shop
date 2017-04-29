<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Category;
use ShopBundle\Entity\PromoType;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\PromotionRepository")
 */
class Promotion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     * @ORM\Column(name="percentage", type="integer")
     */
    private $percentage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    
    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    
    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @var PromoType
     *
     * @ORM\ManyToOne(targetEntity="PromoType")
     * @ORM\JoinColumn(name="promotype_id", referencedColumnName="id")
     */
    private $promoType;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set percentage
     *
     * @param integer $percentage
     *
     * @return Promotion
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return int
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Promotion
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Promotion
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    
    public function setProduct($product){
        $this->product = $product;
        return $this;
    }
    
    public function getProduct(){
        return $this->product;
    }
    
     public function setCategory($category){
        $this->category = $category;
        return $this;
    }
    
    public function getCategory(){
        return $this->category;
    }
    
    public function setPromoType($promoType){
        $this->promoType = $promoType;
        return $this;
    }
    
    public function getPromoType(){
        return $this->promoType;
    }
}

