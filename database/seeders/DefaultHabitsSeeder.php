<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultHabitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('default_habits')->truncate();

        $defaultHabits = [
            [
                'id' => 1,
                'title' => "Laisser des restes de nourriture dans l'évier",
                'category' => config('constants.KITCHEN'),
                'description' => "Il semblerait que votre partenaire vous ait pris en flagrant délit de laissage de pourriture dans l'évier.",
                'path_icon' => 'habit_evier',
            ],
            [
                'id' => 2,
                'title' => "Laisser traîner un trognon de pomme.",
                'category' => config('constants.KITCHEN'),
                'description' => "Il semblerait que votre partenaire vous ait pris en flagrant délit de laissage de trognon!",
                'path_icon' => 'habit_evier',
            ],
            [
                'id' => 3,
                'title' => "Laisser un habit traîner au sol.",
                'category' => config('constants.KITCHEN'),
                'description' => "Il semblerait que votre partenaire vous ait pris en flagrant délit de laissage d'habit sur le sol.",
                'path_icon' => 'habit_evier',
            ],
        ];

        // id: string;
        // title: string;
        // description: string;
        // is_done: boolean;
        // path_icon_todo: string;
        // click_level: number;
        // is_liked: boolean;

        DB::table('default_habits')->insert($defaultHabits);
    }
}
