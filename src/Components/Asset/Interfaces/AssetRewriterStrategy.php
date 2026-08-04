<?php

namespace App\Components\Asset\Interfaces;

use Spider\Page;

interface AssetRewriterStrategy
{
    public function rewrite(Page $page): void;
}
