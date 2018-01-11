<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class SitemapParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sm:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Пансинг страниц найденных в sitemap.xml с сайтов доноров';

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
        $siteMap = simplexml_load_file($siteMapUrl);

        $parser = new \Src\Parsers\KedemRuParser;

        $mysqlStorage = new \Src\Storages\MysqlStorage();
        $recipesService = new \Src\RecipesService();

        foreach ($siteMap->url as $url) {
            $locUrlPath = parse_url($url->loc, PHP_URL_PATH);
            if (substr($locUrlPath, 1, 6) !== 'recipe') {
                continue;
            }

            try {
                $content = file_get_contents($url->loc);
                $crawler = new Crawler($content);
                $recipe = $parser->getRecipeByCrawler($crawler);
            } catch (\Exception $e) {
                continue;
            }

            if (!$recipe) {
                continue;
            }

            $recipesService->storeRecipe($recipe, $mysqlStorage);
        }
    }
}
