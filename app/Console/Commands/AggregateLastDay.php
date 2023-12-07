<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AggregateLastDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregate:last-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate last day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->format('Y-m-d 00:00:00');
        $yesterday = now()->yesterday()->format('Y-m-d 00:00:00');

        DB::insert("INSERT INTO aggregates_by_day (aggregate_at, device_type_id, country_id, total, created_at, updated_at) SELECT DATE(created_at) AS aggregate_at, device_type_id, country_id, COUNT(*) AS total, NOW() AS created_at, NOW() AS updated_at FROM clicks WHERE created_at >= '{$yesterday}' AND created_at < '{$today}' GROUP BY aggregate_at, device_type_id, country_id");
    }
}
