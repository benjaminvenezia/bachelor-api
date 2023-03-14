<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $usersToAdd = [
            [
                'id' => 1,
                'name' => "Thierry",
                'personal_code' => 'aaa',
                'other_code' => 'bbb',
                'email' => "ben@gmail.com",
                'password' => Hash::make("password"),
                'points' => 0,
            ],
            [
                'id' => 2,
                'name' => "Marjorie",
                'personal_code' => 'bbb',
                'other_code' => 'aaa',
                'email' => "noemi@gmail.com",
                'password' => Hash::make("password"),
                'points' => 0,
            ]
        ];

        DB::table('users')->insert($usersToAdd);

        // Gage::factory()->count(5)->create();

        // Group::factory()->count(1)->create();

        // Task::factory()->count(20)->create();
    }
}
