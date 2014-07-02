<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Schema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create 'users' table
		Schema::create('users', function($t) {
				$t->increments('id');
				$t->string('username', 16);
				$t->string('password', 64);
				$t->string('email');
				$t->integer('level');
				$t->string('state',64);
				$t->timestamps();
		});

		//Create 'bulbs' table
		Schema::create('bulbs', function($t) {
				$t->increments('id');
				$t->string('ip', 16);
				$t->string('address', 200);
				$t->string('latitude');
				$t->string('longtitude');
				$t->string('state',64);
				$t->integer('currbrightness');
				$t->string('mode',10);
				$t->string('name',200);
				$t->timestamps();
		});

		//Create 'clusters'




	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
