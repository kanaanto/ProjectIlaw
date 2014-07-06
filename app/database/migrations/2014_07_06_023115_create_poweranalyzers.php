<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoweranalyzers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('poweranalyzers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bulb_id')->unsigned()->index();
			$table->string('stat',45);
			$table->string('watts',45);
			$table->string('va',45);
			$table->string('var_',45);
			$table->string('pf',45);
			$table->string('volt',45);
			$table->string('ampere',45);
			$table->timestamp('timestamp');
			$table->timestamps();
			$table->foreign('bulb_id')->references('id')->on('bulbs');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('poweranalyzers');
	}

}
