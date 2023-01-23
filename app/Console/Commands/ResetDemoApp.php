<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ResetDemoApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phza24:reset-demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the demo application';

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
        // \Log::info('DEMO APP RESET COMMAND CALLED!');

        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $this->call('down'); // Maintenance mode on

        Schema::disableForeignKeyConstraints();

        // To import demo content using SQL dump file
        // $this->call('phza24:seed-sql');

        // These two command to import demo content using factory and seeders
        $this->call('phza24:fresh');
        $this->call('phza24:demo');

        // if ( config('app.demo') != true )
        //     $this->call('phza24:boost');

        Schema::enableForeignKeyConstraints();

        $this->call('up'); // Maintenance mode off
    }
}
