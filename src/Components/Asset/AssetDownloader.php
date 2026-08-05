<?php

namespace App\Components\Asset;

use Kit\Net\Request;
use Kit\Support\Arr;
use PhpX\Utils\Console\Console;
use Kit\Net\Exceptions\RequestException;

use App\Components\Url\Path;
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

        $this->downloadAsset(label: "CSS", directory: "css", assets: $styles);
        $this->downloadAsset(label: "JS", directory: "js", assets: $scripts);
        $this->downloadAsset(label: "IMG", directory: "images", assets: $images);
    }

    private function downloadAsset(
        string $label,
        string $directory,
        array $assets,
    ): void {
        if (empty($assets)) return;

        foreach ($assets as $asset) {
            echo Console::info(
                label: $label,
                message: "Downloading \"{$asset}\"...",
            ) . PHP_EOL;

            try {
                $content = Request::get($asset);
            } catch (RequestException $e) {
                echo Console::error(
                    label: "HTTP",
                    message: "Failed to download \"{$asset}\"",
                ) . PHP_EOL;

                continue;
            }

            $filePath = Path::create(
                asset($directory) . $this->getAssetFile($asset),
            );

            $this->storage->save($filePath, $content);

            echo Console::success(
                label: $label,
                message: "Downloaded \"{$asset}\".",
            ) . PHP_EOL;
        }
    }
}
