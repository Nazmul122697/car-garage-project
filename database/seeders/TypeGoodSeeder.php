<?php

namespace Database\Seeders;

use App\Models\TypeGood;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = ['Meat','Fish','Vegetable'];

        foreach ($datas as $data) {
            TypeGood::create([
                'name' => $data,
                'status' => 1
            ]);
        }
    }
}
