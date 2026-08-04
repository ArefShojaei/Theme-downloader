<?php

namespace App\Components\Path\Interfaces;

interface Path
{
    public static function root(): string;

    public static function get(string $path): string;

    public static function create(string $path): string;

    public static function name(string $path): string;

    public static function file(string $path): string;
}
