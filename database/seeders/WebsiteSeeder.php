<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Website::create([
            'copy_right' => "Copyright © 2023 All Rights Reserved
             Government of the People's Republic of Bangladesh",
            'facebook' => 'https://www.facebook.com/',
            'linkedin' => 'https://bd.linkedin.com/',
            'youtube' => 'https://youtube.com/',
            'logo' => null,
            'favicon' => null,
            'email' => 'info@bfsa.gov.bd',
            'reporting_email' => 'bfsa.gov@gmail.com',
            'feedback_email' => 'complain.bfsa@gmail.com',
            'phone1' => '+8802-222223458',
            'phone2' => '+8802-222223459',
            'lab' => '40',
            'parameter' => '812',
            'food_type' => '133'
        ]);
    }
}
