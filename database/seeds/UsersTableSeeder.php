<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'      => 'Admin',
        	'username'  => 'admin',
        	'email'     => 'admin@agrimap.com',
        	'password'  =>  bcrypt('admin'),
        	'role_id'   =>  1,
            'created_at' => date('Y-m-d H:i:s')
         ]);
    }
}
