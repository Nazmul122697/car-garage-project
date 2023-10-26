<?php

namespace Database\Seeders;

use App\Models\FeeStructure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeeStructure::create([
            'id' => 1,
            'min' => 0,
            'max' => 999999,
            'fee' => 2000,
        ]);
        FeeStructure::create([
            'id' => 2,
            'min' => 1000000,
            'max' => 5000000,
            'fee' => 3000,
        ]);
        FeeStructure::create([
            'id' => 3,
            'min' => 5000001,
            'max' => 999999999999999,
            'fee' => 5000,
        ]);
    }
}
