<?php

use Illuminate\Database\Seeder;

class CropsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crops')->insert([
        	['name' => 'Cassava'],
			['name' => 'Soyabean'],
			['name' => 'Cowpea'],
			['name' => 'Okro'],
			['name' => 'Millet'],
			['name' => 'Maize'],
			['name' => 'Pepper'],
			['name' => 'Lettuce'],
			['name' => 'Onion'],
			['name' => 'Watermelon'],
			['name' => 'Garden eggs'],
			['name' => 'Cocoyam'],
			['name' => 'Cucumber'],
			['name' => 'Rice'],
			['name' => 'Sorghum'],
			['name' => 'Plantain'],
			['name' => 'Cabbage'],
			['name' => 'Groundnuts'],
			['name' => 'Yam'],
			['name' => 'Tomato'],
        ]);
    }
}
