<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProgressmanUrlCorrector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'progressman:urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Progressman url corrector';

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
        $progressmanUrlCorrector = new \App\Services\ProgressmanUrlCorrector;
        $progressmanUrlCorrector->massCorrect();
    }
}
