<?php

namespace App\Components\Url;

use Kit\Support\Str;

use App\Components\Url\Exceptions\InvalidUrlException;
use App\Components\Url\Interfaces\UrlParser as IUrlParser;

final class UrlParser implements IUrlParser
{
    private const ROOT_REGEX_PATTERN = "/(?<root>.+)\/.+\.html/";

    public function __construct(private array $options) {}

    public static function parse(string $url): self
    {
        if (!Str::isURL($url)) {
            throw new InvalidUrlException();
        }

        return new self(parse_url($url));
    }

    public function get(): string
    {
        $root = $this->getRoot();

        return $this->scheme() . "://" . $this->host() . $root;
    }

    public function scheme(): string
    {
        return $this->options["scheme"];
    }

    public function host(): string
    {
        return $this->options["host"];
    }

    public function path(): string
    {
        return $this->options["path"];
    }

    private function getRoot(): string
    {
        $path = $this->path() ?? false;

        if (!$path) {
            return "";
        }

        preg_match(self::ROOT_REGEX_PATTERN, $path, $matches);

        if (!count($matches)) {
            return "";
        }

        return $matches["root"];
    }
}
