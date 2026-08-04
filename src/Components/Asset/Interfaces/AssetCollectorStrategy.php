<?php

namespace App\Components\Asset\Interfaces;

use Spider\Page;

interface AssetCollectorStrategy
{
    public function collect(Page $page): array;
}
