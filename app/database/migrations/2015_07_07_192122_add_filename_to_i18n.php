<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilenameToI18n extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('consults', function($table) {
			$table->dropColumn('filename')->nullable();
		});

		Schema::table('consults_i18n', function($table) {
			$table->string('filename', 100)->nullable();
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
		Schema::table('consults', function($table) {
			$table->string('filename', 100)->nullable();
		});

		Schema::table('consults_i18n', function($table) {
			$table->dropColumn('filename')->nullable();
		});
	}

}
