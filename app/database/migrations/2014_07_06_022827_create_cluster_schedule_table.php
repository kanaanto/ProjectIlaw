<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClusterScheduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cluster_schedule', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cluster_id')->unsigned()->index();
			$table->foreign('cluster_id')->references('id')->on('clusters')->onDelete('cascade');
			$table->integer('schedule_id')->unsigned()->index();
			$table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cluster_schedule');
	}

}
