<?php

namespace Rhubarb\SecurePasswordInput\Controls;

use Rhubarb\Leaf\Controls\Common\Text\PasswordTextBox;

class ZxcvbnPasswordTextBox extends PasswordTextBox
{
    protected function getViewClass()
    {
        return ZxcvbnPasswordTextBoxView::class;
    }
}
