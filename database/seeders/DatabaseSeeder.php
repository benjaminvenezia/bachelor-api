<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gage;
use App\Models\Group;
use App\Models\User;
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


        // création de deux utilisateurs avec la factory
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // création de 5 gages pour chaque utilisateur
        Gage::factory()->count(5)->create(['user_id' => $user1->id]);
        Gage::factory()->count(5)->create(['user_id' => $user2->id]);

        Group::factory(Group::class, 3)->create();



        DB::table('groups')->insert(
            [
                [
                    'id' => 1,
                    'name' => "Le groupe des ptits choux",
                    'user_id1' => 1,
                    'user_id2' => 2,
                ],
                [
                    'id' => 2,
                    'name' => "Le groupe des ptits poupou",
                    'user_id1' => 3,
                    'user_id2' => 4,
                ]
            ]
        );

        $tasksToAdd = [
            [
                'id' => 1,
                'group_id' => 1,
                'category' => 'kitchen',
                'title' => "faire à manger",
                'description' => "Vous devez préparer le repas.",
                'reward' => 12,
                'isDone' => false,
                'associated_day' => 'Lun',
            ],
            [
                'id' => 2,
                'group_id' => 1,
                'category' => 'kitchen',
                'title' => "nettoyer la table",
                'description' => "il faut nettoyer la table.",
                'reward' => 20,
                'isDone' => false,
                'associated_day' => 'Lun',
            ],
            [
                'id' => 3,
                'group_id' => 2,
                'category' => 'kitchen',
                'title' => "nettoyer la table",
                'description' => "il faut nettoyer la table ben.",
                'reward' => 10,
                'isDone' => false,
                'associated_day' => 'Lun',
            ],
            [
                'id' => 4,
                'group_id' => 2,
                'category' => 'kitchen',
                'title' => "Test",
                'description' => "il faut nettoyer.",
                'reward' => 10,
                'isDone' => false,
                'associated_day' => 'Lun',
            ]
        ];


        DB::table('tasks')->insert($tasksToAdd);
    }
}
