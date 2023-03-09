<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gage;
use App\Models\Group;
use App\Models\Task;
use App\Models\User;
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

        User::factory()->count(2)->create();

        Gage::factory()->count(5)->create();

        Group::factory()->count(1)->create();

        Task::factory()->count(20)->create();
    }
}
