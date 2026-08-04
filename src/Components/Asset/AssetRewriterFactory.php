<?php

namespace App\Components\Asset;

use Spider\Page;

use App\Components\Asset\Interfaces\AssetRewriter;
use App\Components\Asset\Interfaces\AssetRewriterFactory as IAssetRewriterFactory;
use App\Components\Asset\Rewriters\{
    LinkRewriter,
    StyleRewriter,
    ScriptRewriter,
    ImageRewriter,
};
use App\Components\Asset\Strategies\{
    LinkRewriterStrategy,
    StyleRewriterStrategy,
    ScriptRewriterStrategy,
    ImageRewriterStrategy,
};

final class AssetRewriterFactory implements IAssetRewriterFactory
{
    public function __construct(private Page $page) {}

    public function createLinkRewriter(): AssetRewriter
    {
        return new LinkRewriter($this->page, new LinkRewriterStrategy());
    }

    public function createStyleRewriter(): AssetRewriter
    {
        return new StyleRewriter($this->page, new StyleRewriterStrategy());
    }

    public function createScriptRewriter(): AssetRewriter
    {
        return new ScriptRewriter($this->page, new ScriptRewriterStrategy());
    }

    public function createImageRewriter(): AssetRewriter
    {
        return new ImageRewriter($this->page, new ImageRewriterStrategy());
    }
}
