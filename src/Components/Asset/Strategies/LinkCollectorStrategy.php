<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;
use Kit\Support\Arr;

use App\Components\Asset\Resolvers\UrlResolver;
use App\Components\Asset\Interfaces\AssetCollectorStrategy;

class LinkCollectorStrategy implements AssetCollectorStrategy
{
    public function __construct(private UrlResolver $resolver) {}

    public function collect(Page $page): array
    {
        $links = [];

        $page
            ->findAll("link[href]")
            ->each(function ($_, $element) use (&$links) {
                $attributes = $element->attr();

                if (Arr::get($attributes, "rel") !== "stylesheet") return;

                $href = Arr::get($attributes, "href");

                if (empty($href) || str_contains($href, "#")) return;

                $links[] = $this->resolver->resolve($href);
            });

        return $links;
    }
}
