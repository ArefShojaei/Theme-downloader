<?php

namespace App\Console\Commands;

use Spider\Spider;
use Kit\Net\Request;
use Kit\Support\{Str, Arr};
use PhpX\Utils\Console\Console;
use PhpX\Components\Console\Command;

use App\Components\Theme\ThemeBuilder;

final class ThemeDownloaderCommand extends Command
{
    public function exec(array $params): string
    {
        $url = Arr::get($params, "url");

        if (!Str::isURL($url)) return Console::error(label: "VALIDATION", message: "Invalid URL!");

        echo Console::info(
            label: "START",
            message: "\"{$url}\" discovery template...",
        ) . PHP_EOL;

        $html = (string) Request::get($url);

        if (Str::isEmpty($html) || Str::isJSON($html))
            Console::error(label: "VALIDATION", message: "Response content is not valid HTML output!");

        /**
         * Load DOM Tree
         */
        $spider = new Spider();

        $page = $spider->loadHTML($html);

        /**
         * Create Theme
         * 1- Setup Builder
         * 2- Configure
         * 3- Collect Styles, Scripts, Images & Links addresses
         * 4- Rewrite Styles, Scripts, Images & Links addresses
         * 5- Download
         */
        $theme = (new ThemeBuilder)
            ->setName(pathinfo($url, PATHINFO_FILENAME))
            ->setPage($page)
            ->build();

        $theme->configure(dirname(__DIR__, 3) . "/tmp");

        $theme->collect();

        $theme->rewrite();

        $theme->download();

        return Console::success(
            label: "END",
            message: "the template discovery done successfully.",
        );
    }
}
