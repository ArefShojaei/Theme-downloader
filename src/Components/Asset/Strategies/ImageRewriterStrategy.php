<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\Arr;

use App\Components\Url\Path;
use App\Components\Asset\Interfaces\AssetRewriterStrategy;

final class ImageRewriterStrategy implements AssetRewriterStrategy
{
    public function rewrite(Page $page): void
    {
        $page->findAll("img[src]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $src = Arr::get($attributes, "src");

            if (!empty($src) || isset($src)) {
                $path = Path::create("/assets/images/" . Path::file($src));

                $element->attr("src", $path);
            }
        });
    }
}
