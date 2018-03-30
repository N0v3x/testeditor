<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswerTable extends Migration {

	public function up()
	{
		Schema::create('Answer', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30);
			$table->boolean('correct')->default(0);
			$table->integer('id_question')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Answer');
	}
}