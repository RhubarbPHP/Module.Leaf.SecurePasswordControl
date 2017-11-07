<?php

namespace Rhubarb\SecurePasswordInput\Models\Authentication;

use Rhubarb\SecurePasswordInput\Traits\SecurePasswordConsistencyValidationErrorsTrait;

class User extends \Rhubarb\Scaffolds\Authentication\User
{
    use SecurePasswordConsistencyValidationErrorsTrait;

    public function setNewPassword($password)
    {
        $this->getSecurePasswordValidationErrors($password);
        parent::setNewPassword($password);
    }
}
