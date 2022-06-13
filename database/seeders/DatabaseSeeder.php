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
        $theTester = \App\Models\User::firstWhere('email', config('seeder.tester_email'));

        // Create The Tester if not exists.
        if (empty($theTester)) {
            $theTester = $this->createTester();
        }

        // Create 5 random users.
        \App\Models\User::factory(5)->create();
    }

    /**
     * Create an user as "The Tester".
     */
    private function createTester()
    {
        return \App\Models\User::factory()->create([
            'name' => config('seeder.tester_name'),
            'email' => config('seeder.tester_email'),
            'password' => bcrypt(config('seeder.tester_password')),
            'is_admin' => config('seeder.tester_is_admin'),
        ]);
    }
}
