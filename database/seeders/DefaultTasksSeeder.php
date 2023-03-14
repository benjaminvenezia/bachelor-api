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

        $defaultTasks = [

            [
                'id' => 1,
                'category' => 'kitchen',
                'title' => "Faire la vaisselle à la main",
                'description' => "La récompense de cette tâche sera à la hauteur de la peine.",
                'reward' => 30,
                'path_icon_todo' => "balai"
            ]

        ];

        DB::table('default_tasks')->insert($defaultTasks);
    }
}
