<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ShopBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\CartRepository")
 */
class Cart
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
    *  @var User
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
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
    public function getUser()
    {
        return $this->user;
    }  
    public function setUser($user)
    {
       $this->user = $user;
       return $this;
    }  
    
    
   
}

