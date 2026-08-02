<?php

namespace App\Components\Asset;

use Spider\Page;

use App\Components\Asset\Interfaces\AssetCollector;

abstract class BaseAssetCollector implements AssetCollector
{
    protected array $links = [];

    public function __construct(protected Page $page) {}

    public function toArray(): array
    {
        return $this->links;
    }

    abstract public function collect(): self;
}
