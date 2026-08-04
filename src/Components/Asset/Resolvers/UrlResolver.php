<?php

namespace App\Components\Asset\Resolvers;

use App\Components\Url\Domain;
use App\Components\Asset\Interfaces\UrlResolver as IUrlResolver;

class UrlResolver implements IUrlResolver
{
    public function resolve(string $url): string
    {
        $url = str_replace("./", "/", $url);
        
        if (filter_var($url, FILTER_VALIDATE_URL)) return $url;

        if (str_starts_with($url, "http")) return $url;

        return Domain::get() . "/" . ltrim($url, "/");
    }
}
