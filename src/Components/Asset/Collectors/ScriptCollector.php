<?php

namespace App\Components\Asset\Collectors;

use Kit\Support\Arr;

use App\Components\Asset\BaseAssetCollector;

final class ScriptCollector extends BaseAssetCollector
{
    public function collect(): self
    {
        $this->page->findAll("script[src]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $src = Arr::get($attributes, "src");

            if (!empty($src) && !str_contains($src, "#")) {
                $this->links[] = $src;
            }
        });

        return $this;
    }
}
