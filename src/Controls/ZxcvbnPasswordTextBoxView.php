<?php

namespace Rhubarb\Scaffolds\SecurePasswordInput\Controls;

use Rhubarb\Leaf\Controls\Common\Text\TextBoxView;

class ZxcvbnPasswordTextBoxView extends TextBoxView
{
    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/../../../dropbox/zxcvbn/dist/zxcvbn.js';
        return $package;
    }
}
