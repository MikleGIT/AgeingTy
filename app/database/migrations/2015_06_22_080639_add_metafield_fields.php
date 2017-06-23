<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetafieldFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('meta_data', function($table) {
			$table->increments('id');
			$table->string('meta_key', 200)->nullable();
			$table->text('meta_fields')->nullable();
			$table->text('data')->nullable();
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
		Schema::drop('meta_data');

	}

}
