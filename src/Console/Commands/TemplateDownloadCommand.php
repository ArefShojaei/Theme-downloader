<?php

namespace App\Console\Commands;

use Spider\Spider;
use Kit\Support\Str;
use Kit\Net\Request;
use PhpX\Utils\Console\Console;
use PhpX\Components\Console\Command;

use App\Components\Storage\StorageFactory;
use App\Components\Asset\{
    AssetAggregator,
    AssetCollectorFactory,
    AssetDownloader,
};

final class TemplateDownloadCommand extends Command
{
    public function exec(array $params): string
    {
        $url = $params["url"];

        if (!Str::isURL($url)) {
            return Console::error("Invalid Page url!");
        }

        echo Console::info(
            label: "START",
            message: "\"{$url}\" discovery template...",
        ) . PHP_EOL;

        $html = (string) Request::get($url);

        if (Str::isEmpty($html) || Str::isJSON($html)) {
            return Console::error("Response content is not valid HTML output!");
        }

        $spider = new Spider();

        $page = $spider->loadHTML($html);

        $assetFactory = new AssetCollectorFactory($page);

        $aggregator = new AssetAggregator(
            style: $assetFactory->createStyleCollector(),
            script: $assetFactory->createScriptCollector(),
            image: $assetFactory->createImageCollector(),
            link: $assetFactory->createLinkCollector(),
        );

        $storage = StorageFactory::create(
            dirname(__DIR__, 3) . "/tmp/",
            pathinfo($url, PATHINFO_FILENAME),
        );

        $storage->save("index.html", $html);

        $downloader = new AssetDownloader($aggregator, $storage);

        $downloader->download();

        return Console::success(
            label: "END",
            message: "the template discovery done successfully.",
        );
    }
}
