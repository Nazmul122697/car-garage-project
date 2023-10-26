<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
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
        User::updateOrCreate([
            'role_id'  => Role::where('slug','admin')->first()->id,
            'name'     => 'Admin',
            'email'    => 'admin@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','customer')->first()->id,
            'name'     => 'Customer',
            'email'    => 'customer@app.com',
            'phone'    => '01830000000',
            'division' => 6,
            'district' => 47,
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','fa')->first()->id,
            'name'     => 'FA',
            'email'    => 'fa@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','fso')->first()->id,
            'name'     => 'FSO',
            'email'    => 'fso@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','lab')->first()->id,
            'name'     => 'LAB',
            'email'    => 'lab@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','so')->first()->id,
            'name'     => 'SO',
            'email'    => 'so@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','director')->first()->id,
            'name'     => 'Director',
            'email'    => 'director@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug','member')->first()->id,
            'name'     => 'Member',
            'email'    => 'member@app.com',
            'password' => Hash::make('password'),
            'status'   => true
        ]);
    }
}
