<?php

namespace App\Components\Asset;

use App\Components\Asset\Interfaces\Rewriteable;
use App\Components\Asset\Rewriters\{
    FontRewriter,
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
        private FontRewriter $font,
    ) {}

    public function rewrite(): void
    {
        $this->link->rewrite();

        $this->image->rewrite();

        $this->style->rewrite();

        $this->script->rewrite();

        $this->font->rewrite();
    }
}
