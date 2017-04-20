<?php

namespace ShopBundle\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;
use ShopBundle\Entity\User;
class ChangePasswordModel  {

     /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     */
    private $oldPassword;

    /**
     * @Assert\Length(
     *     min = 3,
     *     minMessage = "Password should by at least 3 chars long"
     * )
     */
    private $newPassword;
    
    /**
     * Set oldPassword     
     * @param string $oldPassword     
     * @return ChangePasswordModel
     */
    public function setOldPassword($oldPassword)
    {
        $this->email = $oldPassword;
        return $this;
    }

    /**
     * Get oldPassword    
     * @return string
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }
    
    /**
     * Set newPassword     
     * @param string $newPassword     
     * @return ChangePasswordModel
     */
    public function setNewPassword($newPassword)
    {
        $this->email = $newPassword;
        return $this;
    }

    /**
     * Get newPassword    
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }
}
