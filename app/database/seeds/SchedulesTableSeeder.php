<?php

class SchedulesTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('schedules')->delete();
		
		Schedule::create(array(
			'start_time' => '18:00:00',
			'end_time' => '6:00:00',
			'brightness' => 20,
			'start_date' =>'2014-04-10',
			'end_date' =>'2014-04-20',
		));

		Schedule::create(array(
			'start_time' => '17:00:00',
			'end_time' => '5:30:00',
			'brightness' => 80,
			'start_date' =>'2014-04-01',
			'end_date' =>'2014-04-02',
		));

		Schedule::create(array(
			'start_time' => '17:30:00',
			'end_time' => '6:00:00',
			'brightness' => 80,
			'start_date' =>'2014-03-27',
			'end_date' =>'2014-03-28',
		));
	}

}
