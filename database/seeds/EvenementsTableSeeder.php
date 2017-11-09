<?php

use Illuminate\Database\Seeder;

class EvenementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $iterations = 2;
        $evenements = [
            [
                'date_debut' => date("Y-m-d H:i:s", strtotime('-' . rand(0, 24*365) . 'hours' )),
                'date_fin' => date("Y-m-d H:i:s", strtotime('-' . rand(0, 24*365) . 'hours' )),
                'titre' => 'Test',
                'description' => 'Articles test',
                'auteur_id' => 291,
            ],
            [
                'date_debut' => date("Y-m-d H:i:s", strtotime('-' . rand(0, 24*365) . 'hours' )),
                'date_fin' => date("Y-m-d H:i:s", strtotime('-' . rand(0, 24*365) . 'hours' )),
                'titre' => 'Test2',
                'description' => 'Articles test2',
                'auteur_id' => 291,
            ]
        ];

        for ($i = 0; $i < $iterations; $i++)
        {
            foreach ($evenements as $evenement) {
                DB::table('evenements')->insert($evenement);
            }
        }

    }
}
