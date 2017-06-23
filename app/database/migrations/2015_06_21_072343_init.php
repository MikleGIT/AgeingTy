<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Init extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('languages', function($table) {
			$table->increments('id');
			$table->string('code', 20);
			$table->string('name', 50);
			$table->timestamps();
		});

		Schema::create('attachments', function($table) {
			$table->increments('id');
			$table->string('filename', 200)->nullable();
			$table->integer('user_id');
			$table->timestamps();
		});

		Schema::create('posts', function($table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->integer('user_id');
			//$table->boolean('embed')->default(false);
			$table->string('image_filename', 100)->nullable();
			$table->timestamps();
		});

		Schema::create('posts_i18n', function($table) {
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('language_id');
			$table->string('title', 200)->nullable();
			$table->text('content')->nullable();
			$table->text('excerpt')->nullable();
			$table->timestamps();
		});

		Schema::create('categories', function($table) {
			$table->increments('id');
			$table->integer('parent_id')->nullable();
			$table->string('slug', 100)->nullable();
			$table->string('type', 20)->nullable();
			$table->string('section', 50)->nullable();
			$table->string('url', 100)->nullable();
			$table->string('image_filename', 100)->nullable();
			$table->integer('sorting')->default(0);
			$table->timestamps();
		});

		Schema::create('categories_i18n', function($table) {
			$table->increments('id');
			$table->integer('language_id');
			$table->integer('category_id');
			$table->string('name', 50)->nullable();
			$table->timestamps();
		});

		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username', 100);
			$table->string('password', 100);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('languages');
		Schema::drop('attachments');
		Schema::drop('posts');
		Schema::drop('posts_i18n');
		Schema::drop('categories');
		Schema::drop('categories_i18n');
		Schema::drop('users');
	}

}
