<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(TypeGoodSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(WebsiteSeeder::class);
        $this->call(TermServiceSeeder::class);
        $this->call(FeeStructureSeeder::class);
        $this->call(TutorialSeeder::class);
        $this->call(NatureOfCompanySeeder::class);
        $this->call(ModeOfTransportSeeder::class);
        $this->call(ChangeRequestFeeSeeder::class);
        $this->call(FaqSeeder::class);
    }
}
