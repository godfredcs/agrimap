<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(CropsSeeder::class);
        $this->call(DistrictCropsSeeder::class);
    }
}
