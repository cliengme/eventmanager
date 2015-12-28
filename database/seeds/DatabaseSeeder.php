<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('EventTableSeeder');
		$this->command->info('Event table seeded!');

		$this->call('GuestTableSeeder');
		$this->command->info('Guest table seeded!');

		$this->call('EventguestTableSeeder');
		$this->command->info('Eventguest table seeded!');
                
                $this->call('UserTableSeeder');
		$this->command->info('User table seeded!');
	}
}