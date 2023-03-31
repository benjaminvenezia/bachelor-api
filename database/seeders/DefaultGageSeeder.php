<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultGageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('default_gages')->truncate();

        $defaultGagesKitchen = [
            [
                'id' => 1,
                'category' => config('constants.KITCHEN'),
                'title' => "Faire la vaisselle à la main",
                'description' => "Vous devez en guise de reparation faire la vaisselle à la main.",
                'cost' => 200,
            ],
            [
                'id' => 2,
                'category' => config('constants.KITCHEN'),
                'title' => "Remplir et lancer la machine à laver la vaisselle",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'cost' => 140,
            ],
            [
                'id' => 3,
                'category' => config('constants.KITCHEN'),
                'title' => "Lancer la machine à laver la vaisselle",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'cost' => 60,
            ],
            [
                'id' => 4,
                'category' => config('constants.KITCHEN'),
                'title' => "Nettoyer les miettes sur la table",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'cost' => 140,
            ],
            [
                'id' => 5,
                'category' => config('constants.KITCHEN'),
                'title' => "Ranger les courses",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'cost' => 60,
            ]
        ];

        $defaultGagesRoom = [
            [
                'id' => 6,
                'category' => config('constants.ROOM'),
                'title' => "Une tâche liée à la chambre 1",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'cost' => 100,
            ],
            [
                'id' => 7,
                'category' => config('constants.ROOM'),
                'title' => "Une tâche liée à la chambre 2",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'cost' => 120,
            ]
        ];

        DB::table('default_gages')->insert($defaultGagesKitchen);
        DB::table('default_gages')->insert($defaultGagesRoom);
    }
}
