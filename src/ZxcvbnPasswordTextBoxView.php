<?php

namespace Rhubarb\Scaffolds\SecurePasswordInput;

use Rhubarb\Leaf\Controls\Common\Text\TextBoxView;

class ZxcvbnPasswordTextBoxView extends TextBoxView
{
    protected function getViewBridgeName()
    {
        return "ZxcvbnPasswordTextBoxViewBridge";
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/ZxcvbnPasswordTextBoxViewBridge.js';
        return $package;
    }
}
