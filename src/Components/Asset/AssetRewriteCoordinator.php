<?php

namespace App\Components\Asset;

use App\Components\Asset\Interfaces\Rewriteable;
use App\Components\Asset\Rewriters\{
    ImageRewriter,
    LinkRewriter,
    ScriptRewriter,
    StyleRewriter,
};

final class AssetRewriteCoordinator implements Rewriteable
{
    public function __construct(
        private LinkRewriter $link,
        private ImageRewriter $image,
        private StyleRewriter $style,
        private ScriptRewriter $script,
    ) {}

    public function rewrite(): void
    {
        $this->link->rewrite();

        $this->image->rewrite();

        $this->style->rewrite();

        $this->script->rewrite();
    }
}
