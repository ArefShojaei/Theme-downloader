<?php

namespace App\Components\Asset;

use App\Components\Asset\Interfaces\Aggregatable;
use App\Components\Asset\Collectors\{
    StyleCollector,
    ScriptCollector,
    ImageCollector,
    LinkCollector,
};

final class AssetAggregator implements Aggregatable
{
    public function __construct(
        private StyleCollector $style,
        private ScriptCollector $script,
        private ImageCollector $image,
        private LinkCollector $link,
    ) {}

    public function aggregate(): array
    {
        return [
            "styles" => $this->style->collect()->toArray(),
            "scripts" => $this->script->collect()->toArray(),
            "links" => $this->link->collect()->toArray(),
            "images" => $this->image->collect()->toArray(),
        ];
    }
}
