<?php

class BulbClusterTableSeeder extends Seeder
{

	public function run()
	{
		Bulbcluster::create(array(
			'bulb_id' => 1,
			'cluster_id' => 1
		));

		Bulbcluster::create(array(
			'bulb_id' => 1,
			'cluster_id' => 2
		));

		Bulbcluster::create(array(
			'bulb_id' => 2,
			'cluster_id' => 2
		));

		Bulbcluster::create(array(
			'bulb_id' => 3,
			'cluster_id' => 1
		));
		
		Bulbcluster::create(array(
			'bulb_id' => 3,
			'cluster_id' => 2
		));

		Bulbcluster::create(array(
			'bulb_id' => 2,
			'cluster_id' => 1
		));
	}

}
