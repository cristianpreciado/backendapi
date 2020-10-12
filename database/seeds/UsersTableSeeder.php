<?php

use App\Users;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Users::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.
        $password = Hash::make('secure');

        Users::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => $password,
            'token' => str_random(10),
        ]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            Users::create([
                'first_name' => $faker->firstname,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'password' => $password,
                'token' => str_random(10)
            ]);
        }
    }
}
