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


        $usersToAdd = [
            [
                'id' => 1,
                'name' => "Thierry",
                'email' => "thierry@gmail.com",
                'password' => "thiethie12",
            ],
            [
                'id' => 2,
                'name' => "Marjorie",
                'email' => "Marjorie@gmail.com",
                'password' => "marjo12",

            ]
        ];

        DB::table('users')->insert($usersToAdd);


        DB::table('group')->insert(
            [
                'id' => 1,
                'name' => "Le groupe des ptits choux",
                'user_id1' => 1,
                'user_id2' => 2,
            ]
        );

        $tasksToAdd = [
            [
                'id' => 1,
                'user_id' => 1,
                'category' => 'kitchen',
                'name' => "faire à manger",
                'description' => "Vous devez préparer le repas.",
                'reward' => 12,
                'isDone' => false,
                'associated_day' => 'lun',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'category' => 'kitchen',
                'name' => "nettoyer la table",
                'description' => "il faut nettoyer la table.",
                'reward' => 20,
                'isDone' => false,
                'associated_day' => 'lun',
            ]
        ];


        DB::table('tasks')->insert($tasksToAdd);
    }
}
