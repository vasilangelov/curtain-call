<?php

namespace Database\Seeders;

use App\Models\Theater;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theater::query()
            ->insert([
                [
                    'name' => 'Music and Drama Theatre "Konstantin Kisimov"',
                    'address' => '4 Vasil Levski Blvd.',
                    'city_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'National theater "Ivan Vazov"',
                    'address' => '5 "Dyakon Ignaty" str',
                    'city_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Theatro',
                    'address' => '12 "Varbitsa" str',
                    'city_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'State Opera - Varna',
                    'address' => '1 Nezavisimost Square',
                    'city_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Plovdiv Ancient Theatre',
                    'address' => 'Tsar Ivailo 4',
                    'city_id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
