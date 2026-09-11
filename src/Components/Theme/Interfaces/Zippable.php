<?php

namespace App\Components\Theme\Interfaces;

interface Zippable
{
    public function zip(string $comment, ?string $password = null): void;
}
