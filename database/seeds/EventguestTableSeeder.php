<?php

use Illuminate\Database\Seeder;
use App\Eventguest;

class EventguestTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('event_guest')->delete();

		// EventGuest1
		Eventguest::create(array(
				'guest_id' => 1,
				'event_id' => 1
			));

		// EventGuest2
		Eventguest::create(array(
				'guest_id' => 2,
				'event_id' => 1
			));
	}
}