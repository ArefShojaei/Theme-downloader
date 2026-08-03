<?php

namespace App\Components\Path;

use App\Components\Path\Interfaces\Path as IPath;

final class Path implements IPath
{
    public static function root(): string
    {
        return dirname(__DIR__, 3);
    }

    public static function get(string $path): string
    {
        return self::root() . ($path ? "/" . ltrim($path, "/") : "");
    }

    public static function create(string $path): string
    {
        return $path;
    }

    public static function name(string $path): string
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function file(string $path): string
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }
}
