<?php

namespace App\Components\Asset\Rewriters;

use Kit\Support\Arr;

use App\Components\Asset\BaseAssetRewriter;
use App\Components\Path\Path;

final class StyleRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("link[href]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $rel = Arr::get($attributes, "rel");
            $link = Arr::get($attributes, "href");

            if ($rel === "stylesheet" && !str_contains($link, "#")) {
                $path = Path::create("/assets/css/" . Path::file($link));

                $element->attr("href", $path);
            }
        });
    }
}
