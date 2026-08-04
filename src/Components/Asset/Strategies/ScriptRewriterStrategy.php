<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\Arr;

use App\Components\Url\Path;
use App\Components\Asset\Interfaces\AssetRewriterStrategy;

final class ScriptRewriterStrategy implements AssetRewriterStrategy
{
    public function rewrite(Page $page): void
    {
        $page->findAll("script[src]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $src = Arr::get($attributes, "src");

            if (!empty($src) && !str_contains($src, "#")) {
                $path = Path::create("/assets/js/" . Path::file($src));

                $element->attr("src", $path);
            }
        });
    }
}
