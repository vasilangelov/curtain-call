<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public static function getRoles()
    {
        return [
            [
                'name' => 'superadmin',
                'permissions' => [
                    PermissionSeeder::getPermissionId('create'),
                    PermissionSeeder::getPermissionId('read'),
                    PermissionSeeder::getPermissionId('update'),
                    PermissionSeeder::getPermissionId('delete'),
                    PermissionSeeder::getPermissionId('manage users'),
                ],
            ],
            [
                'name' => 'admin',
                'permissions' => [
                    PermissionSeeder::getPermissionId('create'),
                    PermissionSeeder::getPermissionId('read'),
                    PermissionSeeder::getPermissionId('update'),
                    PermissionSeeder::getPermissionId('delete'),
                ],
            ],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = static::getRoles();

        $roleModels = array_map(fn($role) => [
            'name' => $role['name'],
            'guard_name' => backpack_guard_name(),
            'created_at' => now(),
            'updated_at' => now(),
        ], $roles);

        Role::query()
            ->insert($roleModels);

        $rolePermissionsTable = config('permission.table_names.role_has_permissions');

        $rolePermissionModels = [];

        foreach ($roles as $roleKey => $roleInfo) {
            foreach ($roleInfo['permissions'] as $permissionId) {
                $rolePermissionModels[] = [
                    PermissionRegistrar::$pivotRole => $roleKey + 1,
                    PermissionRegistrar::$pivotPermission => $permissionId,
                ];
            }
        }

        DB::table($rolePermissionsTable)
            ->insert($rolePermissionModels);
    }
}
