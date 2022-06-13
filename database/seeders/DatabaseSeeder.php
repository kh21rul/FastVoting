<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create The Tester.
        $this->createTester();

        // Create 3 random users.
        \App\Models\User::factory(3)->create();
    }

    /**
     * Create an user as "The Tester".
     */
    private function createTester()
    {
        \App\Models\User::factory()->create([
            'name' => config('seeder.tester_name'),
            'email' => config('seeder.tester_email'),
            'password' => bcrypt(config('seeder.tester_password')),
            'is_admin' => config('seeder.tester_is_admin'),
        ]);
    }
}
