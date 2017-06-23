<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsultQuestions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('consult_documents', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->timestamps();
		});

		Schema::create('consult_documents_i18n', function($table) {
			$table->increments('id');
			$table->integer('consult_document_id');
			$table->integer('language_id');
			$table->string('title', 200)->nullable();
			$table->string('filename', 100)->nullable();
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
		Schema::drop('consult_documents');
		Schema::drop('consult_documents_i18n');

	}

}
