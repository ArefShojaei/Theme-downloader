<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\Arr;

use App\Components\Asset\Resolvers\UrlResolver;
use App\Components\Asset\Interfaces\AssetCollectorStrategy;

final class FontCollectorStrategy implements AssetCollectorStrategy
{
    private const REGEX_PATTERN = "/@font-face\s*\{[\s\S]*?\bsrc\s*:\s*url\(\s*['\"]?(?<font>[^'\")]+)['\"]?\s*\)/";

    public function __construct(private UrlResolver $resolver) {}

    public function collect(Page $page): array
    {
        $links = [];

        $page
            ->findAll("link[rel='stylesheet']")
            ->each(function ($_, $element) use (&$links) {
                $attributes = $element->attr();

                if (Arr::get($attributes, "rel") !== "stylesheet") return;

                $href = Arr::get($attributes, "href");

                if (empty($href) || str_contains($href, "#")) return;

                $src = $this->resolver->resolve($href);

                $css = file_get_contents($src);

                preg_match(self::REGEX_PATTERN, $css, $matches);

                if (!empty($matches)) {
                    $font = $matches["font"];

                    $links[] = $this->resolver->resolve($font);
                }
            });

        return $links;
    }
}
