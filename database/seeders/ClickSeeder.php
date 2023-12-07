<?php

namespace Database\Seeders;

use App\Models\Click;
use App\Models\Country;
use App\Models\DeviceType;
use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linkIds = Link::pluck('id');
        $countryIds = Country::pluck('id');
        $deviceTypeIds = DeviceType::pluck('id');

        Click::factory(120)
            ->sequence(fn ($sequence) => [
                'link_id' => $linkIds->random(),
                'country_id' => $countryIds->random(),
                'device_type_id' => $deviceTypeIds->random(),
                'created_at' => now()->subMonths(ceil(($sequence->index + 1) / 10) - 1),
                'updated_at' => now()->subMonths(ceil(($sequence->index + 1) / 10) - 1),
            ])
            ->create();
    }
}
