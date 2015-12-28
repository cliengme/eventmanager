<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('events')->delete();

		// Event1
		Event::create(array(
				'date' => '2015-12-25',
				'place' => 'Genève',
				'name' => 'Noël',
				'capacity' => 8
			));

		// Event2
		Event::create(array(
				'date' => '2015-12-31',
				'place' => 'Lausanne',
				'name' => 'Nouvel an',
				'capacity' => 10
			));

		// Event3
		Event::create(array(
				'date' => '2016-02-22',
				'place' => 'Nyon',
				'name' => 'Anniversaire',
				'capacity' => 5
			));
	}
}