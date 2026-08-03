<?php

namespace App\Components\Storage;

use App\Components\Storage\Interfaces\StorageFactory as IStorageFactory;

final class StorageFactory implements IStorageFactory
{
    public static function create(string $path, string $name): Storage
    {
        $root = $path . "/" . $name . "/";

        $assets = $root . "assets";

        $directories = [
            $assets . "/css",
            $assets . "/js",
            $assets . "/images",
            $assets . "/fonts",
        ];

        return new Storage($root, $directories);
    }
}
