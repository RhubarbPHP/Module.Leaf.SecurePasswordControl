<?php

namespace Rhubarb\SecurePasswordInput\Helpers;

use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;
use ZxcvbnPhp\Zxcvbn;

class PasswordValidator
{
    public static function validatePassword($password): array
    {
        $settings = SecurePasswordInputSettings::singleton();
        $passwordLength = strlen($password);

        if ($settings->minimumLength) {
            if ($passwordLength < $settings->minimumLength) {
                return [false, $settings::MINIMUM_LENGTH_KEY];
            }
        }

        if ($settings->maximumLength) {
            if ($passwordLength > $settings->maximumLength) {
                return [false, $settings::MAXIMUM_LENGTH_KEY];
            }
        }

        if ($settings->minimumRequiredNumbers) {
            preg_match_all('/[0-9]/', $password, $matches);
            $matchesCount = count($matches[0]);
            if ($matchesCount < $settings->minimumRequiredNumbers) {
                return [false, $settings::MINIMUM_REQUIRED_NUMBERS_KEY];
            }
        }

        if ($settings->minimumRequiredUppercaseLetters) {
            preg_match_all('/[A-Z]/', $password, $matches);
            $matchesCount = count($matches[0]);
            if ($matchesCount < $settings->minimumRequiredUppercaseLetters) {
                return [false, $settings::MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY];
            }
        }

        if ($settings->minimumRequiredLowercaseLetters) {
            preg_match_all('/[a-z]/', $password, $matches);
            $matchesCount = count($matches[0]);
            if ($matchesCount < $settings->minimumRequiredLowercaseLetters) {
                return [false, $settings::MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY];
            }
        }

        if ($settings->minimumRequiredSpecialCharacters) {
            preg_match_all('/[(!@#$%^&*).]/', $password, $matches);
            $matchesCount = count($matches[0]);
            if ($matchesCount < $settings->minimumRequiredSpecialCharacters) {
                return [false, $settings::MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY];
            }
        }

        if ($settings->minimumZxcvbnOverallScore) {
            $zxcvbn = new Zxcvbn();
            $overallStrength = $zxcvbn->passwordStrength($password);
            if ($overallStrength['score'] < $settings->minimumZxcvbnOverallScore) {
                return [false, $settings::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY];
            }
        }

        return [true, ""];
    }
}
