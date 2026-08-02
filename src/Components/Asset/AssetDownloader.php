<?php

namespace App\Components\Asset;

use Kit\Net\Request;
use PhpX\Utils\Console\Console;

use App\Components\Asset\Interfaces\Downloadable;
use App\Components\Storage\Storage;

final class AssetDownloader implements Downloadable
{
    public function __construct(
        private AssetAggregator $aggregator,
        private Storage $storage,
    ) {}

    public function download(): void
    {
        $assets = $this->aggregator->aggregate();

        $this->downloadStyles($assets["styles"]);
        $this->downloadScripts($assets["scripts"]);
        $this->downloadImages($assets["images"]);
    }

    private function downloadStyles(array $styles): void
    {
        if (empty($styles)) return;

        foreach ($styles as $style) {
            echo Console::warn(
                label: "CSS",
                message: "Downloading \"{$style}\"...",
            ) . PHP_EOL;

            $content = (string) Request::get($style);

            $path = pathinfo($style, PATHINFO_BASENAME);

            $pathParts = explode("?", $path);

            $filePath = "/assets/css/" . current($pathParts);

            $this->storage->save($filePath, $content);

            echo Console::success(
                label: "CSS",
                message: "Downloaded \"{$style}\".",
            ) . PHP_EOL;
        }
    }

    private function downloadScripts(array $scripts): void
    {
        if (empty($scripts)) return;

        foreach ($scripts as $script) {
            echo Console::warn(
                label: "JAVASCRIPT",
                message: "Downloading \"{$script}\"...",
            ) . PHP_EOL;

            $content = (string) Request::get($script);

            $path = pathinfo($script, PATHINFO_BASENAME);

            $pathParts = explode("?", $path);

            $filePath = "/assets/js/" . current($pathParts);

            $this->storage->save($filePath, $content);

            echo Console::success(
                label: "JAVASCRIPT",
                message: "Downloaded \"{$script}\".",
            ) . PHP_EOL;
        }
    }

    private function downloadImages(array $images): void
    {
        if (empty($images)) return;

        foreach ($images as $image) {
            echo Console::warn(
                label: "IMAGE",
                message: "Downloading \"{$image}\"...",
            ) . PHP_EOL;

            $content = (string) Request::get($image);

            $path = pathinfo($image, PATHINFO_BASENAME);

            $pathParts = explode("?", $path);

            $filePath = "/assets/images/" . current($pathParts);

            $this->storage->save($filePath, $content);

            echo Console::success(
                label: "IMAGE",
                message: "Downloaded \"{$image}\".",
            ) . PHP_EOL;
        }
    }
}
