<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ShopBundle\Entity\Product;
use ShopBundle\Entity\Cart;
/**
 * CartProduct
 *
 * @ORM\Table(name="cart_product")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CartProductRepository")
 */
class CartProduct
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
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */   
  
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var Cart
     * @ORM\ManyToOne(targetEntity="Cart")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     * 
     */
    private $cart;
    
    
    public function __construct() {
        
    }
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
     * Set product
     *
     * @param string $product
     *
     * @return CartProduct
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CartProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function getCart(){
        return $this->cart;
    }
    
    public function setCart($cart){
      $this->cart = $cart;
      return $this;
    }
    
    public function increaseQuantityBy($amount){
        $this->quantity +=$amount;
    }
}


