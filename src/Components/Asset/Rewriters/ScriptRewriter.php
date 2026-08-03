<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class ScriptRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("script[src]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $src = $attributes["src"];

            if (!empty($src) && !str_contains($src, "#")) {
                $root = "/assets/js/";
                $path = $root . pathinfo($src, PATHINFO_BASENAME);

                $element->attr("src", $path);
            }
        });
    }
}
