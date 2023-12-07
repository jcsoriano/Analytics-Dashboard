<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = collect(Http::get('https://restcountries.com/v2/all')->json())
            ->map(fn ($country) => [
                'name' => $country['name'],
                'code' => $country['alpha3Code'],
                'flag' => $country['flag'],
            ]);

        $countries->each(function ($country) {
            Country::factory()->create($country);
        });
    }
}
