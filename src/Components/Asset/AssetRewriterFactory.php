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

final class AssetRewriterFactory implements IAssetRewriterFactory
{
    public function __construct(private Page $page) {}

    public function createLinkRewriter(): AssetRewriter
    {
        return new LinkRewriter($this->page);
    }

    public function createStyleRewriter(): AssetRewriter
    {
        return new StyleRewriter($this->page);
    }

    public function createScriptRewriter(): AssetRewriter
    {
        return new ScriptRewriter($this->page);
    }

    public function createImageRewriter(): AssetRewriter
    {
        return new ImageRewriter($this->page);
    }
}
