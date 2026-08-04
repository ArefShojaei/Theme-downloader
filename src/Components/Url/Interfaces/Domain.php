<?php

namespace App\Components\Path\Interfaces;

interface Domain
{
    public static function set(string $address): void;

    public static function get(): string;
}
