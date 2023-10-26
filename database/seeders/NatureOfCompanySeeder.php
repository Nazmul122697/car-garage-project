<?php

namespace Database\Seeders;

use App\Models\NatureOfCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NatureOfCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Private Limited Company',
            'Public Limited Company',
            'One-person Company',
            'Companies limited by guarantee',
            'Companies with unlimited liabilities',
            'Sole Proprietorship'
        ];

        foreach($names as $name){
            NatureOfCompany::create([
                'name' => $name,
            ]);
        }


    }
}
