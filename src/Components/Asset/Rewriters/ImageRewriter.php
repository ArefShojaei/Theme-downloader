<?php

namespace App\Components\Asset\Rewriters;

use Kit\Support\Arr;

use App\Components\Path\Path;
use App\Components\Asset\BaseAssetRewriter;

final class ImageRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("img[src]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $src = Arr::get($attributes, "src");;

            if (!empty($src) || isset($src)) {
                $path = Path::create("/assets/images/" . Path::file($src));

                $element->attr("src", $path);
            }
        });
    }
}
