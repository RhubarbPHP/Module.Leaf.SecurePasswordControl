<?php

namespace Rhubarb\SecurePasswordInput\Traits;

use Rhubarb\SecurePasswordInput\Helpers\PasswordValidator;
use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;
use Rhubarb\Stem\Exceptions\ModelConsistencyValidationException;

trait SecurePasswordConsistencyValidationErrorsTrait
{
    /**
     * @param $passwordToValidate
     * @throws ModelConsistencyValidationException
     */
    protected function getSecurePasswordValidationErrors($passwordToValidate)
    {
        $errors = [];

        list($isValid, $validationKey) = PasswordValidator::validatePassword($passwordToValidate);
        if (!$isValid) {
            $errors["Password"] = SecurePasswordInputSettings::singleton()->validationErrorMessages[$validationKey];
        }

        if (count($errors) > 0) {
            throw new ModelConsistencyValidationException($errors);
        }
    }
}
