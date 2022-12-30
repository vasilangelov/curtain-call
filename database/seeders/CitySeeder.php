<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    private const CITIES = ['Sofia', 'Varna', 'Burgas', 'Veliko Tarnovo', 'Ruse', 'Plovdiv'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cityModels = array_map(fn($city) => [
            'name' => $city,
            'created_at' => now(),
            'updated_at' => now(),
        ], static::CITIES);

        City::query()->insert($cityModels);
    }
}
