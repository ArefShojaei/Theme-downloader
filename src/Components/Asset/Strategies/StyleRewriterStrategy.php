<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\Arr;

use App\Components\Url\Path;
use App\Components\Asset\Interfaces\AssetRewriterStrategy;

final class StyleRewriterStrategy implements AssetRewriterStrategy
{
    public function rewrite(Page $page): void
    {
        $page->findAll("link[href]")->each(function ($_, $element) {
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
