<?php

namespace App\Components\Asset\Rewriters;

use Kit\Support\Arr;

use App\Components\Path\Path;
use App\Components\Asset\BaseAssetRewriter;

final class ScriptRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("script[src]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $src = Arr::get($attributes, "src");

            if (!empty($src) && !str_contains($src, "#")) {
                $path = Path::create("/assets/js/" . Path::file($src));

                $element->attr("src", $path);
            }
        });
    }
}
