<?php

use Illuminate\Database\Seeder;
use App\Guest;

class GuestTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('guests')->delete();

		// Guest1
		Guest::create(array(
				'first_name' => 'Cedric',
				'last_name' => 'Liengme',
				'email' => 'cliengme@gmail.com',
				'gender' => 'male'
			));

		// Guest2
		Guest::create(array(
				'first_name' => 'John',
				'last_name' => 'Doe',
				'email' => 'john.doe@mail.com',
				'gender' => 'male'
			));

		// Guest3
		Guest::create(array(
				'first_name' => 'Julie',
				'last_name' => 'Smith',
				'email' => 'julie.smith@mail.com',
				'gender' => 'female'
			));
	}
}