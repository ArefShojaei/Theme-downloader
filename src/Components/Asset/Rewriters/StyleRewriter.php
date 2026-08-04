<?php

namespace App\Components\Asset\Rewriters;

use Spider\Page;

use App\Components\Asset\BaseAssetRewriter;
use App\Components\Asset\Interfaces\AssetRewriterStrategy;

final class StyleRewriter extends BaseAssetRewriter
{
    public function __construct(
        private Page $page,
        private AssetRewriterStrategy $strategy,
    ) {}

    public function rewrite(): void
    {
        $this->strategy->rewrite($this->page);
    }
}
