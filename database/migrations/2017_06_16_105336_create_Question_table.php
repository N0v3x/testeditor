<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionTable extends Migration {

	public function up()
	{
		Schema::create('Question', function(Blueprint $table) {
			$table->increments('id');
			$table->string('question', 50);
			$table->integer('id_topic')->unsigned();
			$table->tinyInteger('mark')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Question');
	}
}