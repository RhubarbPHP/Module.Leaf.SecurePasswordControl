<?php

namespace Rhubarb\SecurePasswordInput\Models\AuthenticationWithRoles;

use Rhubarb\SecurePasswordInput\Traits\SecurePasswordConsistencyValidationErrorsTrait;

class User extends \Rhubarb\Scaffolds\AuthenticationWithRoles\User
{
    use SecurePasswordConsistencyValidationErrorsTrait;

    public function setNewPassword($password)
    {
        $this->getSecurePasswordValidationErrors($password);
        parent::setNewPassword($password);
    }
}
