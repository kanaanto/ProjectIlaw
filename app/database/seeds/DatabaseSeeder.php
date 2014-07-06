<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->command->info('users table seeded!');

		$this->call('BulbsTableSeeder');
		$this->command->info('bulbs table seeded!');

		$this->call('ClustersTableSeeder');
		$this->command->info('clusters table seeded!');

		$this->call('SchedulesTableSeeder');
		$this->command->info('schedules table seeded!');

		$this->call('ClusterScheduleTableSeeder');
		$this->command->info('cluster_schdedule table seeded!');

		$this->call('BulbClusterTableSeeder');
		$this->command->info('bulb_cluster table seeded!');

		$this->call('PoweranalyzerTableSeeder');
		$this->command->info('poweranalyzer table seeded!');
	}
}

