<?php

namespace App\Components\Asset\Interfaces;

interface UrlResolver
{
    public function resolve(string $url): string;
}
