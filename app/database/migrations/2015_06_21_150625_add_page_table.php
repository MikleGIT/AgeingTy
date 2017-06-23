<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('pages', function($table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->integer('user_id');
			$table->timestamps();
		});

		Schema::create('pages_i18n', function($table) {
			$table->increments('id');
			$table->integer('page_id');
			$table->integer('language_id');
			$table->string('title', 200)->nullable();
			$table->text('content')->nullable();
			$table->text('excerpt')->nullable();
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
		Schema::drop('pages');
		Schema::drop('pages_i18n');

	}

}
