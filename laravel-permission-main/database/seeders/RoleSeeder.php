<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'writer']);
        // Role::create(['name' => 'user']);

        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'export product']);
        Permission::create(['name' => 'store product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'visit logs']);

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create product');
        $role1->givePermissionTo('store product');
        $role1->givePermissionTo('edit product');
        $role1->givePermissionTo('update product');
        $role1->givePermissionTo('delete product');
        $role1->givePermissionTo('export product');
        $role1->givePermissionTo('visit logs');

        $role2 = Role::create(['name' => 'editor']);
        $role2->givePermissionTo('edit product');
        $role2->givePermissionTo('update product');

        $role3 = Role::create(['name' => 'user']);
    }
}
