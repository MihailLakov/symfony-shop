<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\RoleRepository")
 */
class Role implements RoleInterface
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    
    /**
     * var ArrayCollection
     * @ORM\ManyToMany(targetEntity="ShopBundle\Entity\User", mappedBy="roles")
     */
    private $users;
    
    public function __construct(){
      $this->users = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Get Role
     * 
     * @return type
     */
    public function getRole() {       
        return $this->name;
    }

}

