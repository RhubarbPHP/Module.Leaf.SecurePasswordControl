<?php

namespace Rhubarb\SecurePasswordInput\Models\AuthenticationWithRoles;

use Rhubarb\SecurePasswordInput\Traits\SecurePasswordConsistencyValidationErrorsTrait;

class User extends \Rhubarb\Scaffolds\AuthenticationWithRoles\User
{
    use SecurePasswordConsistencyValidationErrorsTrait;

    protected function getConsistencyValidationErrors()
    {
        $errors = parent::getConsistencyValidationErrors();

        return $this->getSecurePasswordValidationErrors($errors);
    }
}
