<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->string('place');
			$table->string('name');
			$table->integer('capacity');
                        $table->unique(array('date', 'name', 'place'));
		});
	}

	public function down()
	{
		Schema::drop('events');
	}
}