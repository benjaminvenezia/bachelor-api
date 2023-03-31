<?php

namespace Database\Seeders;

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
                'title' => "Remplir et lancer la machine à laver la vaisselle",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 20,
                'path_icon_todo' => "bocal"
            ],
            [
                'id' => 3,
                'category' => config('constants.KITCHEN'),
                'title' => "Lancer la machine à laver la vaisselle",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 10,
                'path_icon_todo' => "bocal"
            ],
            [
                'id' => 4,
                'category' => config('constants.KITCHEN'),
                'title' => "Ranger les courses",
                'description' => "C'est difficile mais vous évitez les mites!",
                'reward' => 15,
                'path_icon_todo' => "bocal"
            ],
            [
                'id' => 5,
                'category' => config('constants.KITCHEN'),
                'title' => "Virer les miettes sur le plan de travail.",
                'description' => "une balayette pourrais vous aider... Je dis ça je dis rien.",
                'reward' => 10,
                'path_icon_todo' => "bocal"
            ]

        ];

        $defaultTasksRoom = [
            [
                'id' => 6,
                'category' => config('constants.ROOM'),
                'title' => "Une tâche liée à la chambre 1",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 30,
                'path_icon_todo' => "balai"
            ],
            [
                'id' => 7,
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
