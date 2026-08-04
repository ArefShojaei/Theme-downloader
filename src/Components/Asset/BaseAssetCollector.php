<?php

namespace App\Components\Asset;

use App\Components\Asset\Interfaces\AssetCollector;

abstract class BaseAssetCollector implements AssetCollector
{
    protected array $links = [];

    public function toArray(): array
    {
        return $this->links;
    }

    abstract public function collect(): self;
}
