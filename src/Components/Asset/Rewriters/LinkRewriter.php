<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class LinkRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("a[href]")->each(function ($_, $element) {
            $element->attr("href", "#");
        });
    }
}
