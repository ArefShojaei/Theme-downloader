<?php

namespace App\Components\Theme;

use Kit\Fs\File;
use Spider\Spider;
use Kit\Net\Request;
use Kit\Support\{Str, Arr};
use PhpX\Utils\Console\Console;

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
        foreach ($pages as $filename => $url) {
            if (!Str::isURL($url)) {
                echo Console::error(
                    label: "VALIDATION",
                    message: "Invalid URL!",
                );

                return;
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
                name: $name,
                path: dirname(__DIR__, 3) . "/tmp",
                file: "{$filename}.html",
            );

            $theme->download();

            $theme->save();
        }
    }

    private function processFonts(array $fonts, string $name): void
    {
        foreach ($fonts as $font) {
            $file = pathinfo($font, PATHINFO_BASENAME);
            $path =
                dirname(__DIR__, 3) .
                "/tmp/" .
                $name .
                "/assets/fonts/" .
                $file;

            $content = Request::get($font);

            File::save($path, $content);
        }
    }
}
