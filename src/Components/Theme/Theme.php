<?php

namespace App\Components\Theme;

use Spider\Page;

use App\Components\Url\Path;
use App\Components\Asset\Resolvers\UrlResolver;
use App\Components\Storage\{Storage, StorageFactory};
use App\Components\Theme\Interfaces\Theme as ITheme;
use App\Components\Asset\{
    AssetAggregator,
    AssetDownloader,
    AssetRewriterFactory,
    AssetCollectorFactory,
    AssetRewriteCoordinator,
};

final class Theme implements ITheme
{
    private AssetAggregator $aggregator;

    private Storage $storage;

    public function __construct(
        private Page $page,
        private string $name,
        private string $path,
        private string $file,
    ) {
        $this->storage = StorageFactory::create($path, $this->name);
    }

    public function download(): void
    {
        $this->collect();

        $downloader = new AssetDownloader($this->aggregator, $this->storage);

        $downloader->download();
    }

    public function save(): void
    {
        $this->rewrite();

        $path = Path::create(
            $this->path . "/" . $this->name . "/" . $this->file,
        );

        $this->page->export($path);
    }

    private function collect(): void
    {
        $resolver = new UrlResolver();

        $collectorFactory = new AssetCollectorFactory($this->page, $resolver);

        $this->aggregator = new AssetAggregator(
            style: $collectorFactory->createStyleCollector(),
            link: $collectorFactory->createLinkCollector(),
            script: $collectorFactory->createScriptCollector(),
            image: $collectorFactory->createImageCollector(),
        );
    }

    private function rewrite(): void
    {
        $rewriterFactory = new AssetRewriterFactory($this->page);

        $coordinator = new AssetRewriteCoordinator(
            link: $rewriterFactory->createLinkRewriter(),
            style: $rewriterFactory->createStyleRewriter(),
            script: $rewriterFactory->createScriptRewriter(),
            image: $rewriterFactory->createImageRewriter(),
        );

        $coordinator->rewrite();
    }
}
