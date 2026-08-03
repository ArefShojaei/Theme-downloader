<?php

namespace App\Components\Asset\Collectors;

use Kit\Support\Arr;

use App\Components\Asset\BaseAssetCollector;

final class LinkCollector extends BaseAssetCollector
{
    public function collect(): self
    {
        $this->page->findAll("a[href]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $link = Arr::get($attributes, "href");

            if (!empty($link) && !str_contains($link, "#")) {
                $this->links[] = $link;
            }
        });

        return $this;
    }
}
