<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        // Créer 10 gages pour chaque utilisateur
        foreach ($users as $user) {
            factory(Gage::class, 10)->create([
                'user_id' => $user->id,
            ]);
        }

        $gages = [
            [
                'title' => 'Faire la vaisselle',
                'description' => 'Laver la vaisselle sale et la ranger',
                'category' => 'cuisine',
                'is_done' => false,
                'date_string' => '2022-03-10',
                'day' => 10,
                'month' => 3,
                'year' => 2022,
                'timestamp' => 1646937600
            ],
        ];
    }
}
