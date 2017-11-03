<?php

namespace Rhubarb\SecurePasswordInput\Settings;

use Rhubarb\Crown\Settings;

/**
 * Container for properties used when checking a Password.
 *
 * @property int $minimumLength                     The minimum total length
 * @property int $maximumLength                     The maximum total length
 * @property int $minimumRequiredNumbers            The minimum count of numbers required
 * @property int $minimumRequiredUppercaseLetters   The minimum count of uppercase letters required
 * @property int $minimumRequiredLowercaseLetters   The minimum count of lowercase letters required
 * @property int $minimumRequiredSpecialCharacters  The minimum count of special characters required
 * @property int $minimumZxcvbnOverallScore         The minimum overall zxcvbn score
 * @property array $validationErrorMessages         The array of validation error messages
 */
class SecurePasswordInputSettings extends Settings
{

    public $minimumLength;

    public $maximumLength;

    public $minimumRequiredNumbers;

    public $minimumRequiredUppercaseLetters;

    public $minimumRequiredLowercaseLetters;

    public $minimumRequiredSpecialCharacters;

    public $minimumZxcvbnOverallScore;

    public $validationErrorMessages;

    protected function initialiseDefaultValues()
    {
        parent::initialiseDefaultValues();

        $this->minimumLength = 0;
        $this->maximumLength = 0;
        $this->minimumRequiredNumbers = 0;
        $this->minimumRequiredUppercaseLetters = 0;
        $this->minimumRequiredLowercaseLetters = 0;
        $this->minimumRequiredSpecialCharacters = 0;
        $this->minimumZxcvbnOverallScore = 4;
        $this->validationErrorMessages = $this->initialiseDefaultValidationErrorMessages();
    }

    /**
     * To ONLY be used when Unit Testing
     */
    public function resetValuesForUnitTesting()
    {
        $this->minimumLength = 0;
        $this->maximumLength = 0;
        $this->minimumRequiredNumbers = 0;
        $this->minimumRequiredUppercaseLetters = 0;
        $this->minimumRequiredLowercaseLetters = 0;
        $this->minimumRequiredSpecialCharacters = 0;
        $this->minimumZxcvbnOverallScore = 0;
        $this->validationErrorMessages = $this->initialiseDefaultValidationErrorMessages();
    }

    private function initialiseDefaultValidationErrorMessages()
    {
        $validationErrorMessages = [];

        $validationErrorMessages[self::MINIMUM_LENGTH_KEY] = "Password must have minimum length";
        $validationErrorMessages[self::MAXIMUM_LENGTH_KEY] = "Password exceeds maximum length";
        $validationErrorMessages[self::MINIMUM_REQUIRED_NUMBERS_KEY] = "Password does not contain enough numbers";
        $validationErrorMessages[self::MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY] = "Password does not contain enough uppercase letters";
        $validationErrorMessages[self::MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY] = "Password does not contain enough lowercase letters";
        $validationErrorMessages[self::MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY] = "Password does not contain enough special characters";
        $validationErrorMessages[self::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY] = "Password is not strong enough";

        return $validationErrorMessages;
    }

    const MINIMUM_LENGTH_KEY = "PasswordMinimumLengthKey";
    const MAXIMUM_LENGTH_KEY = "PasswordMaximumLengthKey";
    const MINIMUM_REQUIRED_NUMBERS_KEY = "PasswordMinimumRequiredNumbersKey";
    const MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY = "PasswordMinimumRequiredUppercaseLettersKey";
    const MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY = "PasswordMinimumRequiredLowercaseLettersKey";
    const MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY = "PasswordMinimumRequiredSpecialCharactersKey";
    const MINIMUM_ZXCVBN_OVERALL_SCORE_KEY = "PasswordMinimumZxcvbnOverallScoreKey";
}
