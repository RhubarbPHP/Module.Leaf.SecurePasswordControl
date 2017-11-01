<?php

namespace Rhubarb\Scaffolds\SecurePasswordInput\Controls;

use Rhubarb\Leaf\Controls\Common\Text\PasswordTextBox;

class ZxcvbnPasswordTextBox extends PasswordTextBox
{
    protected function getViewClass()
    {
        return ZxcvbnPasswordTextBoxView::class;
    }
}
