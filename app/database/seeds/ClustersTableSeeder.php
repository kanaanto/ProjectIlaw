<?php

class ClustersTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('clusters')->delete();
		
		Cluster::create(array(
			'name' => 'Diliman Quezon City Area'
		));

		Cluster::create(array(
			'name' => 'Elliptical Road Area'
		));
			

	}

}
