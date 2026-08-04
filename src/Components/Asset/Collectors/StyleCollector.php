<?php

namespace App\Components\Asset\Collectors;

use Spider\Page;

use App\Components\Asset\BaseAssetCollector;
use App\Components\Asset\Interfaces\AssetCollectorStrategy;

final class StyleCollector extends BaseAssetCollector
{
    public function __construct(
        private Page $page,
        private AssetCollectorStrategy $strategy,
    ) {}

    public function collect(): self
    {
        $this->links = $this->strategy->collect($this->page);

        return $this;
    }
}
