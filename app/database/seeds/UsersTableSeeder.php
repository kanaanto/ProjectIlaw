<?php

class UsersTableSeeder extends Seeder
{

	public function run()
	{
		
		
		User::create(array(
			'username'     => 'admin',
			'password' => Hash::make('admin'),
			'email'    => 'cy@up.edu.ph',
			'level' => '1'
		));

		User::create(array(
			'username'     => 'cy',
			'password' => Hash::make('cy'),
			'email'    => 'cy2@up.edu.ph',
			'level' => '2'
		));

	}

}
