<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'id' => 2,
            'user_id' => 1,
            'category' => 'kitchen',
            'name' => "faire à manger",
            'description' => "Vous devez préparer le repas.",
            'reward' => 12,
            'isDone' => false,
            'associated_day' => 'lun',
        ]);
    }
}
