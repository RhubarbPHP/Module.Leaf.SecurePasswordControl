<?php

namespace Rhubarb\SecurePasswordInput\Settings;

use Rhubarb\Crown\Settings;

class SecurePasswordInputSettings extends Settings
{
    /**
     *  @var int
     *  Set the minimum length
     */
    public $minimumLength = 0;

    /**
     *  @var int
     *  Set the maximum length
     */
    public $maximumLength = 0;

    /**
     *  @var int
     *  Set the minimum amount of numbers
     */
    public $minimumRequiredNumbers = 0;

    /**
     *  @var int
     *  Set the minimum amount of uppercase letters
     */
    public $minimumRequiredUppercaseLetters = 0;

    /**
     *  @var int
     *  Set the minimum amount of lowercase letters
     */
    public $minimumRequiredLowercaseLetters = 0;

    /**
     *  @var int
     *  Set the minimum amount of special characters (!@#$%^&*).
     */
    public $minimumRequiredSpecialCharacters = 0;
}
