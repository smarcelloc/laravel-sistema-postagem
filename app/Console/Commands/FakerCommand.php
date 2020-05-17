<?php

namespace App\Console\Commands;

use App\User;
use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class FakerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'faker:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate faker data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        if(! App::environment('local')){
            abort(403, 'You are not local environment');
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        factory(User::class, 30)->create();
        factory(News::class, 100)->create();
        $this->info('We successfully generate data !!!');
    }
}
