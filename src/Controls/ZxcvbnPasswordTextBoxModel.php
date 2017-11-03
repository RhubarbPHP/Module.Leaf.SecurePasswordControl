<?php

namespace Rhubarb\SecurePasswordInput\Controls;

use Rhubarb\Leaf\Controls\Common\Text\TextBoxModel;
use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;

class ZxcvbnPasswordTextBoxModel extends TextBoxModel
{
    public $minimumLength;

    public $maximumLength;

    public $minimumRequiredNumbers;

    public $minimumRequiredUppercaseLetters;

    public $minimumRequiredLowercaseLetters;

    public $minimumRequiredSpecialCharacters;

    public $minimumZxcvbnOverallScore;

    public $validationErrorMessages;

    public $MINIMUM_LENGTH_KEY = SecurePasswordInputSettings::MINIMUM_LENGTH_KEY;
    public $MAXIMUM_LENGTH_KEY = SecurePasswordInputSettings::MAXIMUM_LENGTH_KEY;
    public $MINIMUM_REQUIRED_NUMBERS_KEY = SecurePasswordInputSettings::MINIMUM_REQUIRED_NUMBERS_KEY;
    public $MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY = SecurePasswordInputSettings::MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY;
    public $MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY = SecurePasswordInputSettings::MINI;
    public $MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY = "PasswordMinimumRequiredSpecialCharactersKey";
    public $MINIMUM_ZXCVBN_OVERALL_SCORE_KEY = "PasswordMinimumZxcvbnOverallScoreKey";

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = "minimumLength";
        $properties[] = "maximumLength";
        $properties[] = "minimumRequiredNumbers";
        $properties[] = "minimumRequiredUppercaseLetters";
        $properties[] = "minimumRequiredLowercaseLetters";
        $properties[] = "minimumRequiredSpecialCharacters";
        $properties[] = "minimumZxcvbnOverallScore";
        $properties[] = "validationErrorMessages";

        $properties[] = "MINIMUM_LENGTH_KEY";

        return $properties;
    }

    public function getState()
    {
        $state = parent::getState();

        $state["MINIMUM_LENGTH_KEY"] = SecurePasswordInputSettings::MINIMUM_LENGTH_KEY;
        $state["MAXIMUM_LENGTH_KEY"] = SecurePasswordInputSettings::MAXIMUM_LENGTH_KEY;
        $state["MINIMUM_REQUIRED_NUMBERS_KEY"] = SecurePasswordInputSettings::MINIMUM_REQUIRED_NUMBERS_KEY;
        $state["MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY"] = SecurePasswordInputSettings::MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY;
        $state["MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY"] = SecurePasswordInputSettings::MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY;
        $state["MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY"] = SecurePasswordInputSettings::MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY;
        $state["MINIMUM_ZXCVBN_OVERALL_SCORE_KEY"] = SecurePasswordInputSettings::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY;

        return $state;
    }
}
