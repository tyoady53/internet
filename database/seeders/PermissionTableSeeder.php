<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'dashboard', 'guard_name' => 'web']);

        Permission::create(['name' => 'customer.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'customer.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'customer.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'customer.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'billing.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'billing.create', 'guard_name' => 'web']);

        Permission::create(['name' => 'payment.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'payment.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'payment.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'payment.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'report', 'guard_name' => 'web']);

        Permission::create(['name' => 'user.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'master-data.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'master-data.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'master-data.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'master-data.delete', 'guard_name' => 'web']);
    }
}
