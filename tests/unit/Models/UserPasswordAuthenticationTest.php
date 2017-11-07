<?php

namespace Rhubarb\SecurePasswordInput\Tests\Models;

use Rhubarb\Crown\Tests\Fixtures\TestCases\RhubarbTestCase;
use Rhubarb\Scaffolds\Authentication\User;
use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;
use Rhubarb\Stem\Exceptions\ModelConsistencyValidationException;
use Rhubarb\Stem\Models\Model;

abstract class UserPasswordAuthenticationTest extends RhubarbTestCase
{
    protected abstract function getUserModel(): User;

    protected function _before()
    {
        parent::_before();
        SecurePasswordInputSettings::singleton()->resetValuesForUnitTesting();
    }

    public function testMinimumLengthValidation()
    {
        SecurePasswordInputSettings::singleton()->minimumLength = 6;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'test';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);
            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password must have minimum length", $exception->getErrors()["Password"]);
        }

        SecurePasswordInputSettings::singleton()->minimumLength = 4;

        try {
            $user->setNewPassword('test');
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testMaximumLengthValidation()
    {
        SecurePasswordInputSettings::singleton()->maximumLength = 10;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'testingthisoutwithareallylongstring';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password exceeds maximum length", $exception->getErrors()["Password"]);
        }

        $user->Password = 'testing';

        try {
            $user->setNewPassword($user->Password);
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testMinimumRequiredNumbersValidation()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredNumbers = 2;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'testing';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password does not contain enough numbers", $exception->getErrors()["Password"]);
        }

        $user->Password = 'tes1ting2';

        try {
            $user->setNewPassword($user->Password);
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testMinimumRequiredUppercaseLettersValidation()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredUppercaseLetters = 2;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'testing';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password does not contain enough uppercase letters", $exception->getErrors()["Password"]);
        }

        $user->Password = 'tes1tingU890U';

        try {
            $user->setNewPassword($user->Password);
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testMinimumRequiredLowercaseLettersValidation()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredLowercaseLetters = 4;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'TESTING';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password does not contain enough lowercase letters", $exception->getErrors()["Password"]);
        }

        $user->Password = 'tes1tingU890U';

        try {
            $user->setNewPassword($user->Password);
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testMinimumRequiredSpecialCharactersValidation()
    {
        SecurePasswordInputSettings::singleton()->minimumRequiredSpecialCharacters = 2;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'testing';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password does not contain enough special characters", $exception->getErrors()["Password"]);
        }

        $user->Password = 'tes(tin..@@gU890U';

        try {
            $user->setNewPassword($user->Password);
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testMinimumRequiredZxcvbnOverallScoreValidation()
    {
        SecurePasswordInputSettings::singleton()->minimumZxcvbnOverallScore = 4;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'testing';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertCount(1, $exception->getErrors());
            $this->assertEquals("Password is not strong enough", $exception->getErrors()["Password"]);
        }

        $user->Password = 'tes@^ Carrot Monkey Giraffe Gorilla';

        try {
            $user->setNewPassword($user->Password);
        } catch (ModelConsistencyValidationException $exception) {
            $this->fail("");
        }
    }

    public function testChangePasswordValidationMessage()
    {
        SecurePasswordInputSettings::singleton()->minimumLength = 6;

        $user = $this->getUserModel();
        $user->Username = 'testuser';
        $user->Password = 'test';
        $user->Forename = 'Authorised';
        $user->Surname = 'User';

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertEquals("Password must have minimum length", $exception->getErrors()["Password"]);
        }

        $validationErrorMessages = SecurePasswordInputSettings::singleton()->validationErrorMessages;
        $validationErrorMessages[SecurePasswordInputSettings::MINIMUM_LENGTH_KEY] = "Your password exceed the minimum length of 6";
        SecurePasswordInputSettings::singleton()->validationErrorMessages = $validationErrorMessages;

        try {
            $user->setNewPassword($user->Password);

            $this->fail("Expected Password Validation exception");
        } catch (ModelConsistencyValidationException $exception) {
            $this->assertEquals("Your password exceed the minimum length of 6", $exception->getErrors()["Password"]);
        }
    }
}
