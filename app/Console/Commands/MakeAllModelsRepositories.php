<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MakeAllModelsRepositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:all-repositories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate all models related files';

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
     * @return int
     */
    public function handle()
    {
        $models = Storage::disk('app')->files('Models');
        foreach ($models as $model) {
            $model = str_replace('.php', null, $model);
            $model=str_replace('/','\\',$model);
            $model=str_replace('Models','',$model);

            Artisan::call('make:repository '.$model.' --namespace="Dashboard\\\V1" --api="V1"');
            $this->info('files related to '.$model.' has been created');
        }
    }
}
