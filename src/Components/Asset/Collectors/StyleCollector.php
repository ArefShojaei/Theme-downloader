<?php

namespace App\Components\Asset\Collectors;

use App\Components\Asset\BaseAssetCollector;

final class StyleCollector extends BaseAssetCollector
{
    public function collect(): self
    {
        $this->page->findAll("link[href]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $rel = $attributes["rel"];
            $link = $attributes["href"];

            if ($rel === "stylesheet" && !str_contains($link, "#")) {
                $this->links[] = $link;
            }
        });

        return $this;
    }
}
