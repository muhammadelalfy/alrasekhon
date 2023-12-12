<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChangeEnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:env {--fromServer=} {--toServer=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change env vars from server options to another';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $fromServer = $this->option('fromServer');
        $toServer = $this->option('toServer');
        $env = '.env';
        $fromName = ".env.$fromServer" ;
        $toName = ".env.$toServer" ;
        $this->info(env('APP_SERVICE'));
        if(rename($env, $fromName))
        {
            if (rename($toName, '.env')){
                $this->info("Successfully Changing env from $fromName to $toName");
                $this->call('optimize:clear');
                $this->call('config:cache');
                $this->info(env('APP_SERVICE'));
            }else{
                $this->error("A File With The Same Name Already Exists");
            }
        }
        else
        {
            $this->error("A File With The Same Name Already Exists");
        }

    }
}
