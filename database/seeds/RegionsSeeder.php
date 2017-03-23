<?php

use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
        	['name' => 'Ashanti Region'],
			['name' => 'Brong Ahafo Region'],
			['name' => 'Central Region'],
			['name' => 'Eastern Region'],
			['name' => 'Greater Accra Region'],
			['name' => 'Northern Region'],
			['name' => 'Volta Region'],
			['name' => 'Upper West Region'],
			['name' => 'Upper East Region'],
			['name' => 'Western Region'],
        ]);
    }
}
