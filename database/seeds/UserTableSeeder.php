<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run() {
        User::truncate();

        User::create(array(
            'email' => 'admin@eventmanager.com',
            'password' => Hash::make('admin'),
            'name' => 'admin',
        ));
    }

}
