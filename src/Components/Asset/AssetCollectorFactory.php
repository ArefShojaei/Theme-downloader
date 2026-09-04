<?php

namespace App\Components\Asset;

use Spider\Page;

use App\Components\Asset\Resolvers\UrlResolver;
use App\Components\Asset\Interfaces\AssetCollector;
use App\Components\Asset\Interfaces\AssetCollectorFactory as IAssetCollectorFactory;
use App\Components\Asset\Collectors\{
    FontCollector,
    ImageCollector,
    LinkCollector,
    ScriptCollector,
    StyleCollector,
};
use App\Components\Asset\Strategies\{
    FontCollectorStrategy,
    ImageCollectorStrategy,
    LinkCollectorStrategy,
    ScriptCollectorStrategy,
    StyleCollectorStrategy,
};

final class AssetCollectorFactory implements IAssetCollectorFactory
{
    public function __construct(
        private Page $page,
        private UrlResolver $resolver,
    ) {}

    public function createLinkCollector(): AssetCollector
    {
        return new LinkCollector(
            $this->page,
            new LinkCollectorStrategy($this->resolver),
        );
    }

    public function createStyleCollector(): AssetCollector
    {
        return new StyleCollector(
            $this->page,
            new StyleCollectorStrategy($this->resolver),
        );
    }

    public function createScriptCollector(): AssetCollector
    {
        return new ScriptCollector(
            $this->page,
            new ScriptCollectorStrategy($this->resolver),
        );
    }

    public function createImageCollector(): AssetCollector
    {
        return new ImageCollector(
            $this->page,
            new ImageCollectorStrategy($this->resolver),
        );
    }

    public function createFontCollector(): AssetCollector
    {
        return new FontCollector(
            $this->page,
            new FontCollectorStrategy($this->resolver),
        );
    }
}
