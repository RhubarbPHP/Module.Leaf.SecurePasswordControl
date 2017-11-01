<?php

namespace Rhubarb\Scaffolds\SecurePasswordInput;

use Rhubarb\Leaf\Controls\Common\Text\PasswordTextBox;

class ZxcvbnPasswordTextBox extends PasswordTextBox
{
    protected function getViewClass()
    {
        return ZxcvbnPasswordTextBoxView::class;
    }

    protected function createModel()
    {
        return new ZxcvbnPasswordTextBoxModel();
    }
}
