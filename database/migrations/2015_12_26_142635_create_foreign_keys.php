<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('event_guest', function(Blueprint $table) {
			$table->foreign('guest_id')->references('id')->on('guests')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('event_guest', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('event_guest', function(Blueprint $table) {
			$table->dropForeign('event_guest_guest_id_foreign');
		});
		Schema::table('event_guest', function(Blueprint $table) {
			$table->dropForeign('event_guest_event_id_foreign');
		});
	}
}