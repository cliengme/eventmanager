<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventGuestTable extends Migration {

	public function up()
	{
		Schema::create('event_guest', function(Blueprint $table) {
			$table->integer('guest_id')->unsigned();
			$table->integer('event_id')->unsigned();
                        $table->primary(['guest_id', 'event_id']);
		});
	}

	public function down()
	{
		Schema::drop('event_guest');
	}
}