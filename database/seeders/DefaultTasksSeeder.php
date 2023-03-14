<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultTasksSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('default_tasks')->truncate();

        $defaultTasksKitchen = [
            [
                'id' => 1,
                'category' => config('constants.KITCHEN'),
                'title' => "Faire la vaisselle à la main",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 30,
                'path_icon_todo' => "bocal"
            ],
            [
                'id' => 2,
                'category' => config('constants.KITCHEN'),
                'title' => "Faire la vaisselle à la main",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 30,
                'path_icon_todo' => "bocal"
            ]

        ];

        $defaultTasksRoom = [
            [
                'id' => 3,
                'category' => config('constants.ROOM'),
                'title' => "Une tâche liée à la chambre 1",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 30,
                'path_icon_todo' => "balai"
            ],
            [
                'id' => 4,
                'category' => config('constants.ROOM'),
                'title' => "Une tâche liée à la chambre 2",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 30,
                'path_icon_todo' => "balai"
            ]

        ];

        DB::table('default_tasks')->insert($defaultTasksKitchen);
        DB::table('default_tasks')->insert($defaultTasksRoom);
    }
}
