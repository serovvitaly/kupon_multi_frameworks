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
    protected $signature = 'sm:load';

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
     *
     * @return mixed
     */
    public function handle()
    {


        $files = scandir('html');

        $parser = new \Src\Parsers\KedemRuParser;

        $mysqlStorage = new \Src\Storages\MysqlStorage();
        $recipesService = new \Src\RecipesService();

        foreach ($files as $fileName) {
            $content = file_get_contents('html/' . $fileName);
            $crawler = new Crawler($content);
            $recipe = $parser->getRecipeByCrawler($crawler);

            if (!$recipe) {
                continue;
            }

            $recipesService->storeRecipe($recipe, $mysqlStorage);
        }
    }
}
