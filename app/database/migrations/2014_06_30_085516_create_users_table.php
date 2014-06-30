<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function($t) {
                $t->increments('id');
                $t->string('username', 16);
                $t->string('password', 64);
                $t->string('email');
                $t->integer('level');
                $t->string('state',64);
                $t->timestamps();
        });

        Schema::create('bulb', function($t) {
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

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		 Schema::drop('users');
		 Schema::drop('bulb');
	}

}
