<?php

namespace App\Components\Asset;

use Kit\Net\Request;
use Kit\Support\Arr;
use PhpX\Utils\Console\Console;

use App\Components\Path\Path;
use App\Components\Storage\Storage;
use App\Components\Asset\Interfaces\Downloadable;

final class AssetDownloader implements Downloadable
{
    public function __construct(
        private AssetAggregator $aggregator,
        private Storage $storage,
    ) {}

    private function getAssetFile(string $path): string
    {
        $file = Path::file($path);

        $parts = explode("?", $file);

        return current($parts);
    }

    public function download(): void
    {
        $assets = $this->aggregator->aggregate();

        $styles = Arr::get($assets, "styles");
        $scripts = Arr::get($assets, "scripts");
        $images = Arr::get($assets, "images");

        $this->downloadStyles($styles);
        $this->downloadScripts($scripts);
        $this->downloadImages($images);
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

            $filePath = Path::create(
                "/assets/css/" . $this->getAssetFile($style),
            );

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
                label: "JS",
                message: "Downloading \"{$script}\"...",
            ) . PHP_EOL;

            $content = (string) Request::get($script);

            $filePath = Path::create(
                "/assets/js/" . $this->getAssetFile($script),
            );

            $this->storage->save($filePath, $content);

            echo Console::success(
                label: "JS",
                message: "Downloaded \"{$script}\".",
            ) . PHP_EOL;
        }
    }

    private function downloadImages(array $images): void
    {
        if (empty($images)) return;

        foreach ($images as $image) {
            echo Console::warn(
                label: "IMG",
                message: "Downloading \"{$image}\"...",
            ) . PHP_EOL;

            $content = (string) Request::get($image);

            $filePath = Path::create(
                "/assets/images/" . $this->getAssetFile($image),
            );

            $this->storage->save($filePath, $content);

            echo Console::success(
                label: "IMG",
                message: "Downloaded \"{$image}\".",
            ) . PHP_EOL;
        }
    }
}
