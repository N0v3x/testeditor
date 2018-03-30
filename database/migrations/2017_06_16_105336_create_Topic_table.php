<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopicTable extends Migration {

	public function up()
	{
		Schema::create('Topic', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 30);
			$table->integer('id_subject')->unsigned();
            $table->integer('id_user')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Topic');
	}
}