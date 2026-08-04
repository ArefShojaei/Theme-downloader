<?php

namespace App\Components\Asset\Strategies;

use Spider\Page;

use App\Components\Asset\Interfaces\AssetRewriterStrategy;

final class LinkRewriterStrategy implements AssetRewriterStrategy
{
    public function rewrite(Page $page): void
    {
        $page->findAll("a[href]")->each(function ($_, $element) {
            $element->attr("href", "#");
        });
    }
}
