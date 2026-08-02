<?php

namespace App\Components\Asset;

use Spider\Page;

use App\Components\Asset\Interfaces\AssetCollector;
use App\Components\Asset\Interfaces\AssetCollectorFactory as IAssetCollectorFactory;
use App\Components\Asset\Collectors\{
    ImageCollector,
    LinkCollector,
    ScriptCollector,
    StyleCollector,
};

final class AssetCollectorFactory implements IAssetCollectorFactory
{
    public function __construct(private Page $page) {}

    public function createLinkCollector(): AssetCollector
    {
        return new LinkCollector($this->page);
    }

    public function createStyleCollector(): AssetCollector
    {
        return new StyleCollector($this->page);
    }

    public function createScriptCollector(): AssetCollector
    {
        return new ScriptCollector($this->page);
    }

    public function createImageCollector(): AssetCollector
    {
        return new ImageCollector($this->page);
    }
}
