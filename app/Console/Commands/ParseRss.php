<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ParseRss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:parse-rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $urlDataSources = \App\Models\UrlDataSource::where('is_active', true)->get();

        if (!count($urlDataSources)) {
            return;
        }

        $service = new \DataSource\Services\RssItemToArticleConverter;
        $httTransport = new \App\Services\CurlHttpTransport;

        foreach ($urlDataSources as $urlDataSource) {

            if (!class_exists($urlDataSource->provider)) {
                $this->error('Class not exists: ' . $urlDataSource->provider);
                continue;
            }

            $dataProvider = new $urlDataSource->provider;

            if (!is_a($dataProvider, \DataSource\DataProviderInterface::class)) {
                $this->error('Class not is a DataProviderInterface: ' . $urlDataSource->provider);
                continue;
            }

            $service->parseRssAndStoreArticlesByRssUrl($urlDataSource->url, $httTransport, $dataProvider);
        }
    }
}
