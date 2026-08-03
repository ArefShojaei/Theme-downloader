<?php

namespace App\Components\Theme\Interfaces;

interface ThemeFactory
{
    public function create(
        string $name,
        string $path,
        string $file = "index.html",
    ): Theme;
}
