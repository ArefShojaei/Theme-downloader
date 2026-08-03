<?php

namespace App\Components\Asset\Interfaces;

interface AssetRewriterFactory
{
    public function createLinkRewriter(): AssetRewriter;

    public function createStyleRewriter(): AssetRewriter;

    public function createScriptRewriter(): AssetRewriter;

    public function createImageRewriter(): AssetRewriter;
}
