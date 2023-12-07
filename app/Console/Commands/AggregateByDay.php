<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AggregateByDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregate:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate by day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::insert("INSERT INTO aggregates_by_day (aggregate_at, device_type_id, country_id, total) SELECT DATE(created_at) AS aggregate_at, device_type_id, country_id, COUNT(*) AS total FROM clicks GROUP BY aggregate_at, device_type_id, country_id");
    }
}
