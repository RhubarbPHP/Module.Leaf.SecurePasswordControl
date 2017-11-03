<?php

namespace Rhubarb\SecurePasswordInput\Tests\Helpers;

use Rhubarb\Crown\Tests\Fixtures\TestCases\RhubarbTestCase;
use Rhubarb\SecurePasswordInput\Helpers\PasswordValidator;
use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;

class PasswordValidatorTest extends RhubarbTestCase
{
    protected function _before()
    {
        parent::_before();
        SecurePasswordInputSettings::singleton()->resetValuesForUnitTesting();
    }

    public function testMinimumLength()
    {
        SecurePasswordInputSettings::singleton()->minimumLength = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid, "Minimum Length of zero should be ignored");
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumLength = 4;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumLength = 5;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_LENGTH_KEY, $validationKey);
    }

    public function testMaximumLength()
    {
        SecurePasswordInputSettings::singleton()->maximumLength = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid, "Maximum Length of zero should be ignored");
        $this->assertEquals($validationKey, "");

        SecurePasswordInputSettings::singleton()->maximumLength = 4;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->maximumLength = 5;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('testing');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MAXIMUM_LENGTH_KEY, $validationKey);
    }

    public function testMinimumRequiredNumbers()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredNumbers = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid, "Minimum Required Numbers of zero should be ignored");
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredNumbers = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_REQUIRED_NUMBERS_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredNumbers = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('te1st');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_REQUIRED_NUMBERS_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredNumbers = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('te1s1t');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredNumbers = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('t89est14');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);
    }

    public function testMinimumRequiredUppercaseLetters()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredUppercaseLetters = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid, "Minimum Required Uppercase Letters of zero should be ignored");
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredUppercaseLetters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('tesT');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_REQUIRED_UPPERCASE_LETTERS_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredUppercaseLetters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('tEsT');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredUppercaseLetters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('REsT');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);
    }

    public function testMinimumRequiredLowercaseLetters()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredLowercaseLetters = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid, "Minimum Required Lowercase Letters of zero should be ignored");
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredLowercaseLetters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('tEST');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_REQUIRED_LOWERCASE_LETTERS_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredLowercaseLetters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('teSt');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);
    }

    public function testMinimumRequiredSpecialCharacters()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredSpecialCharacters = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredSpecialCharacters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('tEST');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredSpecialCharacters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('teSt');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_REQUIRED_SPECIAL_CHARACTERS_LETTERS_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredSpecialCharacters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('teSt@#');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumRequiredSpecialCharacters = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('teSt@#ash1^&45djsauasd');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);
    }

    public function testMinimumZxcvbnScore()
    {
        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 0;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertTrue($isValid, "Minimum Score of zero should be ignored");
        $this->assertEquals("", $validationKey);

        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 1;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 2;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 3;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 4;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('test');
        $this->assertFalse($isValid);
        $this->assertEquals(SecurePasswordInputSettings::MINIMUM_ZXCVBN_OVERALL_SCORE_KEY, $validationKey);

        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 4;
        list($isValid, $validationKey) = PasswordValidator::validatePassword('monkey giraffe carrot computer');
        $this->assertTrue($isValid);
        $this->assertEquals("", $validationKey);
    }
}
