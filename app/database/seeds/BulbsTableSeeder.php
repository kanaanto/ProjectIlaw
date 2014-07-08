<?php

class BulbsTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('bulbs')->delete();
		
		Bulb::create(array(
			'ip'     => '192.168.2.4',
			'address' => 'Roxas Avenue, Quezon City, Philippines',
			'latitude'    => '14.654724728461096',
			'longitude' => '121.06472724547734',
			'state' => 'on',
			'currbrightness'=>51,
			'mode'=>'control',
			'name'=>'Oblation Lamp'
		));

		Bulb::create(array(
			'ip'     => '192.168.2.5',
			'address' => 'University Avenue, Quezon City, Philippines',
			'latitude'    => '14.65395662152603',
			'longitude' => '121.05417007079473',
			'state' => 'off',
			'currbrightness'=>0,
			'mode'=>'control',
			'name'=>'Philcoa Lamp'
		));

		Bulb::create(array(
			'ip'     => '192.168.2.6',
			'address' => 'Maharlika, Quezon City, Philippines',
			'latitude'    => '14.650489726993586',
			'longitude' => '121.05228179564824',
			'state' => 'cnbr',
			'currbrightness'=>0,
			'mode'=>'control',
			'name'=>'Maharlika Lamp'
		));
			

	}

}
