<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		DB::table('bulb')->delete();
		
		User::create(array(
			'username'     => 'admin',
			'password' => Hash::make('awesome'),
			'email'    => 'cy@up.edu.ph',
			'level' => '1'
		));

	}

}