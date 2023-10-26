<?php

namespace Database\Seeders;

use App\Models\ChangeRequestFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChangeRequestFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChangeRequestFee::create([
            'fee' => '500',
            'vat' => '15',
            'tax' => '10',
        ]);
    }
}
