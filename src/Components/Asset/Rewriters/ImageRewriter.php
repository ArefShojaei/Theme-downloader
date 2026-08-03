<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class ImageRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("img[src]")->each(function ($_, $element) {
            $element->attr("src", "#");
        });
    }
}
