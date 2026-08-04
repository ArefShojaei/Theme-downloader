<?php

namespace App\Components\Path;

use Exception;

use App\Components\Path\Interfaces\Domain as IDomain;

final class Domain implements IDomain
{
    private static ?string $address = null;

    public static function set(string $address): void
    {
        if (self::$address) {
            throw new Exception("Domain has already been set!");
        }

        self::$address = $address;
    }

    public static function get(): string
    {
        if (!self::$address) {
            throw new Exception("Domain has not been set.");
        }

        return self::$address;
    }
}
