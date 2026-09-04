<?php

namespace App\Components\Theme;

use Spider\Spider;
use Kit\Net\Request;
use Kit\Support\Str;
use PhpX\Utils\Console\Console;
use Kit\Net\Exceptions\RequestException;

use App\Components\Url\{Path, Domain};
use App\Components\Theme\Interfaces\Processor as IProcessor;

final class ThemeProcessor implements IProcessor
{
    public function __construct(private array $themes) {}

    public function process(): void
    {
        foreach ($this->themes as $name => $pages) {
            $this->processPages($pages, $name);
        }
    }

    private function processPages(array $pages, string $name): void
    {
        if (empty($pages)) return;

        foreach ($pages as $filename => $url) {
            if (!Str::isURL($url)) {
                echo Console::error(
                    label: "VALIDATION",
                    message: "Invalid URL!",
                ) . PHP_EOL;

                return;
            }

            Domain::set($url);

            echo Console::info(
                label: "START",
                message: "\"{$url}\" theme page discovery...",
            ) . PHP_EOL . PHP_EOL;

            try {
                $html = Request::get($url);
            } catch (RequestException $e) {
                echo Console::error(
                    label: "HTTP",
                    message: "Failed to get \"{$url}\"",
                ) . PHP_EOL;

                continue;
            }

            if (Str::isEmpty($html) || Str::isJSON($html)) {
                echo Console::error(
                    label: "VALIDATION",
                    message: "Response content is not valid HTML output!",
                ) . PHP_EOL;
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

            $themeName = $name;
            $themePath = Path::get("dist");
            $themeFile = "{$filename}.html";

            $theme = $factory->create(
                name: $themeName,
                path: $themePath,
                file: $themeFile,
            );

            $theme->download();

            $theme->save();

            echo PHP_EOL . Console::success(
                label: "END",
                message: "\"{$url}\" theme page discovery",
            ) . PHP_EOL;

            echo Console::warn(
                label: "PATH",
                message: "See in \"{$themePath}/{$themeName}\"",
            ) . PHP_EOL;
        }
    }
}
