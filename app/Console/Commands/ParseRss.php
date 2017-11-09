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
        $rssUrl = 'http://xn--b1aga5aadd.xn--p1ai/rss/news.php';
        $httTransport = new \App\Services\CurlHttpTransport;
        $dataProvider = new \App\DataProviders\VoennoeRfDataProvider;

        $service = new \DataSource\Services\RssItemToArticleConverter;
        $service->parseRssAndStoreArticlesByRssUrl($rssUrl, $httTransport, $dataProvider);
    }
}
