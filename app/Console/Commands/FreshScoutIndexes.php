<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FreshScoutIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phza24:fresh-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will flush and reindex all models with schout search.';

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
        $this->call('scout:flush', ["model" => "App\Models\Product"]);
        $this->call('scout:import', ["model" => "App\Models\Product"]);

        $this->call('scout:flush', ["model" => "App\Models\Inventory"]);
        $this->call('scout:import', ["model" => "App\Models\Inventory"]);

        $this->call('scout:flush', ["model" => "App\Models\Customer"]);
        $this->call('scout:import', ["model" => "App\Models\Customer"]);

        $this->call('scout:flush', ["model" => "App\Models\Category"]);
        $this->call('scout:import', ["model" => "App\Models\Category"]);

        return 0;
    }
}
