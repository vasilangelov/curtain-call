<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadminName = env('SUPERADMIN_NAME', 'test');
        $superadminEmail = env('SUPERADMIN_EMAIL', 'test@test.com');
        // NOTE: it is best to keep the seeded superadmin password in the .env file, but for demo purposes it could fallback to '123123'
        $superadminPassword = env('SUPERADMIN_PASSWORD', '123123');

        User::query()
            ->create([
                'name' => $superadminName,
                'email' => $superadminEmail,
                'password' => Hash::make($superadminPassword),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $userRolesTable = config('permission.table_names.model_has_roles');

        $roles = RoleSeeder::getRoles();
        $superadminRoleId = array_search('superadmin', array_column($roles, 'name')) + 1;
        $userIdColumn = config('permission.column_names.model_morph_key');

        DB::table($userRolesTable)
            ->insert([
                PermissionRegistrar::$pivotRole => $superadminRoleId,
                'model_type' => User::class,
                $userIdColumn => 1,
            ]);
    }
}
