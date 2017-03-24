g<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
            ['name' => 'System Administrator', 'system_name' => 'sys_admin'],
            ['name' => 'Administrator', 'system_name' => 'admin'],
        ]);
    }
}
