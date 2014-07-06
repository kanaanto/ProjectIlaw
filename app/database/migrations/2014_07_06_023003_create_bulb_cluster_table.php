<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBulbClusterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bulb_cluster', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bulb_id')->unsigned()->index();
			$table->foreign('bulb_id')->references('id')->on('bulbs')->onDelete('cascade');
			$table->integer('cluster_id')->unsigned()->index();
			$table->foreign('cluster_id')->references('id')->on('clusters')->onDelete('cascade');
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
		Schema::drop('bulb_cluster');
	}

}
