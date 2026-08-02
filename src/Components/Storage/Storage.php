<?php

namespace App\Components\Storage;

use Kit\Fs\{Directory, File};

use App\Components\Storage\Interfaces\Storage as IStorage;

final class Storage implements IStorage
{
    public function __construct(
        private string $root,
        private array $directories,
    ) {
        if (!Directory::has($root)) Directory::create($root);

        foreach ($directories as $directory) {
            if (!Directory::has($directory)) Directory::create($directory);
        }
    }

    public function save(string $file, string $content): bool
    {
        $path = $this->root . "/" . $file;

        if (!File::has($path)) return File::save($path, $content);

        return false;
    }
}
