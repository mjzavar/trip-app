<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use function Laravel\Prompts\confirm;

class deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:build';

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
            'migration' => 'php artisan migrate:fresh  --force' ,
            'seed' => 'php artisan db:seed' ,
        ];

//        $fresh   = $this->choice(
//            'Would you like to create a fresh database ?',
//            ['no' => 'no', 'yes' => 'yes'],
//            'yes'
//        );
//
//        $seed  = $this->choice(
//            'Would you like to seed the database?',
//            ['no' => 'no', 'yes' => 'yes'],
//            'yes'
//        );
//
//
//        if($fresh == 'yes')
//        {
//            $commands['migration'] .= ':fresh';
//        }
//        $commands['migration'] .= ' --force';
//
//        if($seed == 'yes')
//        {
//            $commands['seed'] = 'php artisan db:seed';
//        }

        $this->table(['command to run' ,'type'] , collect($commands)->transform(fn ($command , $type ) => [$command , $type])->toArray());
        $results   = [];
        foreach ($commands as $command => $description) {
                $this->info('running  -> ' . $description)  ;
                $process = Process::timeout(120)->run($description) ;
                $this->line($process->output());
                $results[] = [ $description , $process->successful() ? 'success' : 'error' ] ;

        }
        $this->table(['command ' , 'result'] , $results);


    }
}
