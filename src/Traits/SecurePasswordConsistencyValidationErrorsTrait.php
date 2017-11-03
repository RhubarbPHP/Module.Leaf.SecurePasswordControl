<?php

namespace Rhubarb\SecurePasswordInput\Traits;

use Rhubarb\SecurePasswordInput\Helpers\PasswordValidator;
use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;

trait SecurePasswordConsistencyValidationErrorsTrait
{
    protected function getSecurePasswordValidationErrors(array $errors)
    {
        list($isValid, $validationKey) = PasswordValidator::validatePassword($this->Password);
        if (!$isValid) {
            $errors["Password"] = SecurePasswordInputSettings::singleton()->validationErrorMessages[$validationKey];
        }

        return $errors;
    }
}
