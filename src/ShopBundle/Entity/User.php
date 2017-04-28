<?php

namespace ShopBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\UserRepository")
 */
class User implements AdvancedUserInterface {

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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )    
     */
    private $password;

    /**
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="ShopBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="users_roles",
     *  joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $roles;

    /**
     * @var Float 
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=2)
     */
    private $balance;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct() {
        $this->roles = new ArrayCollection();
        $this->balance = 0;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * set balance
     * @param type $balance
     * @return \ShopBundle\Entity\User
     */
    public function setBalance($balance) {
        $this->balance = $balance;
        return $this;
    }

    /**
     * Get balance
     *
     * @return decimal
     */
    public function getBalance() {
        return $this->balance;
    }

    /**
     *  @return User
     */
    public function increaseBalanceBy($amount) {
        $this->balance += $amount;
        return $this;
    }

    /**
     *  @return User
     */
    public function decreaseBalanceBy($amount) {
        $this->balance -= $amount;
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    public function eraseCredentials() {
        
    }

    public function addRole($role) {
        $this->roles->add($role);
    }

    public function getRoles() {

        $rolesStrings = [];
        foreach ($this->roles as $role) {
            $rolesStrings[] = $role->getName();
        }
        return $rolesStrings;
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->getEmail();
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->isActive;
    }

    public function isActive() {
        return $this->isEnabled();
    }
    
    public function setIsActive($value) {
        $this->isActive = $value;
        return $this;
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->name,
            $this->password,
            $this->email,
            $this->balance,
            $this->roles,
            $this->isActive
        ));
    }

    public function unserialize($serialized) {
        list (
                $this->id,
                $this->name,
                $this->password,
                $this->email,
                $this->balance,
                $this->roles,
                $this->isActive
                ) = unserialize($serialized);
    }

}
