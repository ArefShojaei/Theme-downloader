<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class ImageRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("img[src]")->each(function ($_, $element) {
            $src = $element->attr("src");

            if (!empty($src) || isset($src)) {
                $root = "/assets/images/";
                $path = $root . pathinfo($src, PATHINFO_BASENAME);

                $element->attr("src", $path);
            }
        });
    }
}
