<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()
            ->insert([
                'name' => 'test',
                'email' => 'test@test.com',
                'password' => Hash::make('123123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
