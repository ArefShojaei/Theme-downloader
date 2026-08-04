<?php

/**
 * Get asset path
 */
function asset(string $directory): string
{
    $root = "/assets";

    return "{$root}/{$directory}/";
}
