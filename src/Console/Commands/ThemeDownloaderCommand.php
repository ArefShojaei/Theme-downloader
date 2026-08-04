<?php

namespace App\Console\Commands;

use Kit\Support\Arr;
use PhpX\Utils\Console\Console;
use PhpX\Components\Console\Command;

use App\Components\Path\Domain;
use App\Components\Theme\ThemeProcessor;

final class ThemeDownloaderCommand extends Command
{
    public function exec(array $params): string
    {
        $name = Arr::get($params, "name");
        $url = Arr::get($params, "url");

        Domain::set($url);

        $processor = new ThemeProcessor([
            $name => [
                "pages" => [
                    "index" => $url,
                ],
                "fonts" => [],
            ],
        ]);

        $processor->process();

        return Console::success(
            label: "END",
            message: "the template discovery done successfully.",
        );
    }
}
