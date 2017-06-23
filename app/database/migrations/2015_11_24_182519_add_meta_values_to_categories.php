<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaValuesToCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('categories', function($table) {
			$table->text('inherit_meta_values')->nullable()->after('allow_add_type');
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
			$table->dropColumn('inherit_meta_values');
		});
	}

}
