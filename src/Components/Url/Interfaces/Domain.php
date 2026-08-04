<?php

namespace App\Components\Url\Interfaces;

interface Domain
{
    public static function set(string $address): void;

    public static function get(): string;
}
