<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'title' => 'e-Health Certification System',
                'status' => 1,
            ],
            [
                'title' => 'ই-হেলথ সার্টিফিকেশন সিস্টেম',
                'status' => 1,
            ]
        ];

        foreach ($datas as $data) {
            Slider::create([
                'title' => $data['title'],
                'status' => 1
            ]);
        }
    }
}
