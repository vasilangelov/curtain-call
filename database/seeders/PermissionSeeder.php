<?php

namespace Database\Seeders;

use Backpack\PermissionManager\app\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private const PERMISSIONS = [
        'create',
        'read',
        'update',
        'delete',
        'manage users',
    ];

    public static function getPermissionId(string $permission)
    {
        // NOTE: ids start from 1 and arrays start from 0
        return array_search($permission, static::PERMISSIONS) + 1;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionModels = array_map(fn($permission) => [
            'name' => $permission,
            'guard_name' => backpack_guard_name(),
            'created_at' => now(),
            'updated_at' => now(),
        ], static::PERMISSIONS);

        Permission::query()
            ->insert($permissionModels);
    }
}
