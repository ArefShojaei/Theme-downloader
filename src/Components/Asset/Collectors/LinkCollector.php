<?php

namespace App\Components\Asset\Collectors;

use App\Components\Asset\BaseAssetCollector;

final class LinkCollector extends BaseAssetCollector
{
    public function collect(): self
    {
        $this->page->findAll("a[href]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $link = $attributes["href"];

            if (!empty($link) && !str_contains($link, "#")) {
                $this->links[] = $link;
            }
        });

        return $this;
    }
}
