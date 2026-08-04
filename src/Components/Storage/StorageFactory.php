<?php

namespace App\Components\Storage;

use App\Components\Url\Path;
use App\Components\Storage\Interfaces\StorageFactory as IStorageFactory;

final class StorageFactory implements IStorageFactory
{
    public static function create(string $path, string $name): Storage
    {
        $root = Path::create($path . "/" . $name . "/");

        $assets = Path::create($root . "assets");

        $directories = [
            Path::create($assets . "/css"),
            Path::create($assets . "/js"),
            Path::create($assets . "/images"),
            Path::create($assets . "/fonts"),
        ];

        return new Storage($root, $directories);
    }
}
