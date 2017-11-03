<?php

namespace Rhubarb\SecurePasswordInput\Controls;

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
        $package->resourcesToDeploy[] = __DIR__ . '/../../../../dropbox/zxcvbn/dist/zxcvbn.js';
        $package->resourcesToDeploy[] = __DIR__ . '/../../../../rhubarbphp/module-jsvalidation/src/validation.js';
        $package->resourcesToDeploy[] = __DIR__ . '/ZxcvbnPasswordTextBoxViewBridge.js';

        return $package;
    }
}
