<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use function Laravel\Prompts\confirm;

class deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'running migration';



    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commands = [
            'composer' =>'composer install' ,
            'migration' => 'php artisan migrate' ,
        ];

        $fresh   = $this->choice(
            'Would you like to create a fresh database ?',
            ['no' => 'no', 'yes' => 'yes'],
            'no'
        );

        $seed  = $this->choice(
            'Would you like to seed the database?',
            ['no' => 'no', 'yes' => 'yes'],
            'no'
        );


        if($fresh == 'yes')
        {
            $commands['migration'] .= ':fresh';
        }
        $commands['migration'] .= ' --force';

        if($seed == 'yes')
        {
            $commands['seed'] = 'php artisan db:seed';
        }

        $commands['npm'] = 'npm install';



//        $this->info("seed : $seed");
//        $this->info("fresh : $fresh");
        $this->table(['command to run' ,'type'] , collect($commands)->transform(fn ($command , $type ) => [$command , $type])->toArray());
        $results   = [];
        foreach ($commands as $command => $description) {
                $this->info('running  -> ' . $description)  ;
                $process = Process::run($description) ;
                $this->line($process->output());
                $results[] = [ $description , $process->successful() ? 'success' : 'error' ] ;

        }
        $this->table(['command ' , 'result'] , $results);


    }
}
