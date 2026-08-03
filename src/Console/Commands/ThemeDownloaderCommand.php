<?php

namespace App\Console\Commands;

use Spider\Spider;
use Kit\Net\Request;
use Kit\Support\{Str, Arr};
use PhpX\Utils\Console\Console;
use PhpX\Components\Console\Command;

use App\Components\Theme\ThemeFactory;

final class ThemeDownloaderCommand extends Command
{
    public function exec(array $params): string
    {
        $url = Arr::get($params, "url");

        if (!Str::isURL($url)) {
            return Console::error(label: "VALIDATION", message: "Invalid URL!");
        }

        echo Console::info(
            label: "START",
            message: "\"{$url}\" discovery theme...",
        ) . PHP_EOL;

        $html = (string) Request::get($url);

        if (Str::isEmpty($html) || Str::isJSON($html)) {
            Console::error(
                label: "VALIDATION",
                message: "Response content is not valid HTML output!",
            );
        }

        /**
         * Load DOM Tree
         */
        $spider = new Spider();

        $page = $spider->loadHTML($html);

        /**
         * Create Theme
         *
         * 1- Configure
         * 2- Download
         * 3- Save
         */
        $factory = new ThemeFactory($page);

        $theme = $factory->create(
            name: pathinfo($url, PATHINFO_FILENAME),
            path: dirname(__DIR__, 3) . "/tmp",
            file: "index.html",
        );

        $theme->download();

        $theme->save();

        return Console::success(
            label: "END",
            message: "the template discovery done successfully.",
        );
    }
}
