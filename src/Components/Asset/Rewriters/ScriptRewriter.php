<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class ScriptRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("script[src]")->each(function ($_, $element) {
            $element->attr("src", "#");
        });
    }
}
