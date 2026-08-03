<?php

namespace App\Components\Theme;

use Spider\Page;

use App\Components\Theme\Interfaces\ThemeFactory as IThemeFactory;

final class ThemeFactory implements IThemeFactory
{
    public function __construct(private Page $page) {}

    public function create(
        string $name,
        string $path,
        string $file = "index.html",
    ): Theme {
        return new Theme($this->page, $name, $path, $file);
    }
}
