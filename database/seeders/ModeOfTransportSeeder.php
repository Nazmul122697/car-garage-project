<?php

namespace Database\Seeders;

use App\Models\ModeOfTransport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeOfTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modes = ['Air','Sea','Road'];

        foreach($modes as $mode){
            ModeOfTransport::create([
                'name' => $mode,
                'status' => 1,
            ]);
        }

    }
}
