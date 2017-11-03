<?php

namespace Rhubarb\SecurePasswordInput\Models\Authentication;

use Rhubarb\SecurePasswordInput\Traits\SecurePasswordConsistencyValidationErrorsTrait;

class User extends \Rhubarb\Scaffolds\Authentication\User
{
    use SecurePasswordConsistencyValidationErrorsTrait;

    protected function getConsistencyValidationErrors()
    {
        $errors = parent::getConsistencyValidationErrors();

        return $this->getSecurePasswordValidationErrors($errors);
    }
}
