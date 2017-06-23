<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('consults', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('filename', 100)->nullable();
			$table->timestamps();
		});

		Schema::create('consults_i18n', function($table) {
			$table->increments('id');
			$table->integer('consult_id');
			$table->integer('language_id');
			$table->text('title')->nullable();
			$table->timestamps();
		});

		Schema::create('consult_comments', function($table) {
			$table->increments('id');
			$table->string('name', 200)->nullable();
			$table->string('contact', 200)->nullable();
			$table->integer('consult_id');
			$table->text('message')->nullable();
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
		//
		Schema::drop('consults');
		Schema::drop('consults_i18n');
		Schema::drop('consult_comments');
	}

}
