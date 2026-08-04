<?php

namespace App\Components\Url;

use Exception;

use App\Components\Url\Interfaces\Domain as IDomain;

final class Domain implements IDomain
{
    private static ?string $address = null;

    public static function set(string $address): void
    {
        self::$address = UrlParser::parse($address)->get();
    }

    public static function get(): string
    {
        if (!self::$address) {
            throw new Exception("Domain has not been set.");
        }

        return self::$address;
    }
}
