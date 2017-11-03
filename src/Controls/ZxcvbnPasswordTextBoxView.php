<?php

namespace Rhubarb\SecurePasswordInput\Controls;

use Rhubarb\Leaf\Controls\Common\Text\TextBoxView;

class ZxcvbnPasswordTextBoxView extends TextBoxView
{
    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/../../vendor/dropbox/zxcvbn/dist/zxcvbn.js';
        $package->resourcesToDeploy[] = __DIR__ . '/../../vendor/rhubarbphp/module-jsvalidation/src/validation.js';
        $package->resourcesToDeploy[] = __DIR__ . '/ZxcvbnJsValidations.js';

        return $package;
    }
}
