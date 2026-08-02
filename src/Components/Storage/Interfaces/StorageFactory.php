<?php

namespace App\Components\Storage\Interfaces;

interface StorageFactory
{
    public static function create(string $path, string $name): Storage;
}
