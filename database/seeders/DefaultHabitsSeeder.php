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
                'category' => config('constants.KITCHEN'),
                'title' => "Laisser des restes de nourriture dans l'évier",
                'description' => "Il semblerait que votre partenaire vous ait pris en flagrant délit de laissage de pourriture dans l'évier.",
                'cost' => '["10", "20", "50"]',
            ],
        ];

        DB::table('default_habits')->insert($defaultHabits);
    }
}
