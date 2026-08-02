<?php

namespace App\Components\Asset\Interfaces;

interface AssetCollectorFactory
{
    public function createLinkCollector(): AssetCollector;

    public function createStyleCollector(): AssetCollector;

    public function createScriptCollector(): AssetCollector;

    public function createImageCollector(): AssetCollector;
}
