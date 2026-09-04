<?php

namespace App\Components\Theme;

final class ThemeMeta
{
    public static ?string $name;
    public static ?string $path;

    public static function set(string $name, string $path): void
    {
        self::$name = $name;
        self::$path = $path;
    }

    public static function get(): array
    {
        return [
            "name" => self::$name,
            "path" => self::$path,
        ];
    }
}
