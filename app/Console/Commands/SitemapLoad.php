<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SitemapLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sm:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загрузка sitemap.xml с сайтов доноров';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $siteMapUrl = 'https://kedem.ru/sitemap.xml';

        $siteMaps = [
            'wowfood.club' => 'https://wowfood.club/sitemap.xml',
            'kedem.ru' => 'https://kedem.ru/sitemap.xml',
        ];

        $siteMap = simplexml_load_file($siteMapUrl);

        $counter = 1;
        foreach ($siteMap->url as $url) {
            $locUrlPath = parse_url($url->loc, PHP_URL_PATH);
            if (substr($locUrlPath, 1, 6) !== 'recipe') {
                continue;
            }
            echo $counter . '. ' . $url->loc, PHP_EOL;
            $htmlFileName = 'html/' . str_replace('/', '__', trim(substr($locUrlPath, 7), '/')) . '.html';
            file_put_contents($htmlFileName, file_get_contents($url->loc));
            $counter++;
        }
    }
}
