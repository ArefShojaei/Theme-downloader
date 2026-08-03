<?php

namespace App\Components\Asset\Rewriters;

use App\Components\Asset\BaseAssetRewriter;

final class StyleRewriter extends BaseAssetRewriter
{
    public function rewrite(): void
    {
        $this->page->findAll("link[href]")->each(function ($_, $element) {
            $attributes = $element->attr();

            $rel = $attributes["rel"];
            $link = $attributes["href"];

            if ($rel === "stylesheet" && !str_contains($link, "#")) {
                $root = "/assets/css/";
                $path = $root . pathinfo($link, PATHINFO_BASENAME);

                $element->attr("href", $path);
            }
        });
    }
}
