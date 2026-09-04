<?php

namespace App\Console\Commands;

use Kit\Fs\File;
use Kit\Json\Json;
use PhpX\Utils\Console\Console;
use PhpX\Components\Console\Command;

use App\Components\Url\Path;
use App\Components\Theme\ThemeProcessor;

final class ThemeDownloaderFromConfigCommand extends Command
{
    public function exec(array $params): string
    {
        $configPath = Path::create(Path::root() . "/theme.config.json");

        if (!File::has($configPath)) {
            return Console::error(
                label: "VALIDATION",
                message: "Theme config file doesn't exist!",
            ) . PHP_EOL;
        }

        $content = File::get($configPath);

        $config = Json::decode($content, true);

        $themes = $config;

        $processor = new ThemeProcessor($themes);

        $processor->process();

        return "Done.";
    }
}
