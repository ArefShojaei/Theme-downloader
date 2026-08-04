<?php

namespace App\Components\Path\Interfaces;

interface UrlParser
{
    public static function parse(string $url): self;

    public function get(): string;

    public function scheme(): string;

    public function host(): string;

    public function path(): string;
}
