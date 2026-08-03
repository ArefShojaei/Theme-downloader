<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class StyleRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("link[href]")->each(function ($_, $element) {
            $element->attr("href", "#");
        });
    }
}
