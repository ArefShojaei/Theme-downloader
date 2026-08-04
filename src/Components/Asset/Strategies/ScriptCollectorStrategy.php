<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\Arr;

use App\Components\Asset\Resolvers\UrlResolver;
use App\Components\Asset\Interfaces\AssetCollectorStrategy;

class ScriptCollectorStrategy implements AssetCollectorStrategy
{
    public function __construct(private UrlResolver $resolver) {}

    public function collect(Page $page): array
    {
        $links = [];

        $page
            ->findAll("script[src]")
            ->each(function ($_, $element) use (&$links) {
                $src = Arr::get($element->attr(), "src");

                if (empty($src) || str_contains($src, "#")) return;

                $links[] = $this->resolver->resolve($src);
            });

        return $links;
    }
}
