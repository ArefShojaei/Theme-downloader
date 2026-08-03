<?php

namespace App\Components\Asset;

use Spider\Page;

use App\Components\Asset\Interfaces\AssetRewriter;

abstract class BaseAssetRewriter implements AssetRewriter
{
    public function __construct(protected Page $page) {}

    abstract public function rewrite(): void;
}
