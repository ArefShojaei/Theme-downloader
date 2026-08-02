<?php

namespace App\Components\Storage\Interfaces;

interface Storage
{
    public function save(string $file, string $content): bool;
}
