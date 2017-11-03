<?php

namespace Rhubarb\SecurePasswordInput\Controls;

use Rhubarb\Leaf\Controls\Common\Text\PasswordTextBox;
use Rhubarb\SecurePasswordInput\Settings\SecurePasswordInputSettings;

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

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $settings = SecurePasswordInputSettings::singleton();
        foreach ($settings as $key => $value) {
            $this->model->$key = $value;
        }
    }
}
