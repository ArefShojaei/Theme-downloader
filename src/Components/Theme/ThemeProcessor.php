<?php

namespace App\Components\Theme;

use Kit\Fs\File;
use Spider\Spider;
use Kit\Net\Request;
use Kit\Support\{Str, Arr};
use PhpX\Utils\Console\Console;
use Kit\Net\Exceptions\RequestException;

use App\Components\Url\{Path, Domain};
use App\Components\Theme\Interfaces\Processor as InterfacesProcessor;

final class ThemeProcessor implements InterfacesProcessor
{
    public function __construct(private array $themes) {}

    public function process(): void
    {
        foreach ($this->themes as $name => $options) {
            $pages = Arr::get($options, "pages");
            $fonts = Arr::get($options, "fonts");

            $this->processPages($pages, $name);
            $this->processFonts($fonts, $name);
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
                );

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

    private function processFonts(array $fonts, string $name): void
    {
        if (empty($fonts)) return;

        foreach ($fonts as $font) {
            echo Console::info(
                label: "FONT",
                message: "Downloading \"{$font}\"...",
            ) . PHP_EOL;

            try {
                $content = Request::get($font);
            } catch (RequestException $e) {
                echo Console::error(
                    label: "HTTP",
                    message: "Failed to download \"{$font}\"",
                ) . PHP_EOL;

                continue;
            }

            $path =
                Path::get("dist") .
                Path::create("/{$name}/assets/fonts/") .
                Path::file($font);

            File::save($path, $content);

            echo Console::success(
                label: "FONT",
                message: "Downloaded \"{$font}\".",
            ) . PHP_EOL;
        }
    }
}
