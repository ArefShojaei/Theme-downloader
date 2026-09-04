<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\{Arr, Str};

use App\Components\Url\Path;
use App\Components\Asset\Interfaces\AssetRewriterStrategy;
use App\Components\Theme\ThemeMeta;

final class FontRewriterStrategy implements AssetRewriterStrategy
{
    private const REGEX_PATTERN = "/(@font-face\s*\{.*?\bsrc\s*:\s*url\(\s*['\"]?)(?<font>[^'\")]+)(['\"]?\s*\))/s";

    public function rewrite(Page $page): void
    {
        $page->findAll("link[rel='stylesheet']")->each(function ($_, $element) {
            $href = Arr::get($element->attr(), "href");
            $url = Arr::first(Str::split($href, "?"));

            $meta = ThemeMeta::get();
            $src = $meta["path"] . "/" . $meta["name"] . $url;

            $css = file_get_contents($src);

            preg_match(self::REGEX_PATTERN, $css, $matches);

            if (!empty($matches)) {
                $font = $matches["font"];

                $path = Path::create(asset("fonts") . Path::file($font));

                $content = preg_replace(
                    self::REGEX_PATTERN,
                    "$1" . $path . "$3",
                    $css,
                );

                file_put_contents($src, $content);
            }
        });
    }
}
