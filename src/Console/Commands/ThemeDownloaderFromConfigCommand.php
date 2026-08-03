<?php

namespace App\Console\Commands;

use Kit\Fs\File;
use Kit\Json\Json;
use PhpX\Utils\Console\Console;
use PhpX\Components\Console\Command;

use App\Components\Theme\ThemeProcessor;

final class ThemeDownloaderFromConfigCommand extends Command
{
    public function exec(array $params): string
    {
        $configPath = dirname(__DIR__, 3) . "/theme.config.json";

        if (!File::has($configPath)) {
            return Console::error(
                label: "VALIDATION",
                message: "Theme config file doesn't exist!",
            );
        }

        $content = File::get($configPath);

        $themes = Json::decode($content, true);

        $processor = new ThemeProcessor($themes);

        $processor->process();

        return "Done.";
    }
}
