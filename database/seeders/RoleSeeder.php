<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();

        Role::updateOrCreate([
            'name'  => 'Admin',
            'slug'    => 'admin',
            'deletable' => false
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'name'  => 'Customer',
            'slug'    => 'customer',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name'  => 'FA',
            'slug'    => 'fa',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name'  => 'FSO',
            'slug'    => 'fso',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name'  => 'LAB',
            'slug'    => 'lab',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name'  => 'SO',
            'slug'    => 'so',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name'  => 'Director',
            'slug'    => 'director',
            'deletable' => false
        ]);

        Role::updateOrCreate([
            'name'  => 'Member',
            'slug'    => 'member',
            'deletable' => false
        ]);
    }
}
