<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowSubAddTypeToCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('categories', function($table) {
			$table->string('allow_sub_add_type', 50)->nullable()->after('allow_add_type');
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
		Schema::table('categories', function($table) {
			$table->dropColumn('allow_sub_add_type');
		});
	}

}
