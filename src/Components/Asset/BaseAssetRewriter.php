<?php

namespace App\Components\Asset;

use App\Components\Asset\Interfaces\AssetRewriter;

abstract class BaseAssetRewriter implements AssetRewriter
{
    abstract public function rewrite(): void;
}
