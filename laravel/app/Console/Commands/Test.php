<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test...';

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
     * @return void
     */
    public function handle()
    {
        $document = \App\Models\DocumentModel::findOrFail(890);

        $content = $document->content;
        $content = preg_replace("/<script([.]+?)<\/script>/", "", $content);
        $content = strip_tags($content, '<p><b><img>');
        $content = preg_replace("/[\s]{2,}/", "\n", $content);
        #echo $content;
        $document->content = $content;
        $document->save();

    }
}