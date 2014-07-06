<?php

class ClusterScheduleTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('cluster_schedule')->delete();
		
		Clusterschedule::create(array(
			'cluster_id' => 1,
			'schedule_id' => 1,
			'user_id' => 1
		));

		Clusterschedule::create(array(
			'cluster_id' => 2,
			'schedule_id' => 1,
			'user_id' => 1
		));

	}

}
