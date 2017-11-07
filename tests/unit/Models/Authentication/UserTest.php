<?php

namespace Rhubarb\SecurePasswordInput\Tests\Models\Authentication;

use Rhubarb\SecurePasswordInput\Models\Authentication\User;
use Rhubarb\SecurePasswordInput\Tests\Models\UserPasswordAuthenticationTest;
use Rhubarb\Stem\Models\Model;

class UserTest extends UserPasswordAuthenticationTest
{
    protected function getUserModel(): \Rhubarb\Scaffolds\Authentication\User
    {
        return new User();
    }
}
