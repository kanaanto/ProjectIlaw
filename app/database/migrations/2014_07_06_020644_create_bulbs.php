<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBulbs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bulbs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ip',30);
			$table->string('name');
	        $table->string('address');
	        $table->string('latitude',50);
	        $table->string('longtitude',50);
	        $table->string('state',5);
	        $table->integer('currbrightness');
	        $table->string('mode',10);
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
		Schema::drop('bulbs');
	}

}
