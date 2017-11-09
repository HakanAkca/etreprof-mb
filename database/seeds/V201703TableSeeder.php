<?php

use Illuminate\Database\Seeder;

class V201703TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('vocabularies')->insert([
    		[ 'id' => 16, 'name' => 'Recommandation' ],
    		[ 'id' => 17, 'name' => 'Positionnement/profil' ],
    	]);

		DB::table('terms')->insert([
    		[ 'id' => 200, 'vocabulary_id' => 16, 'name' => 'Recommander ce contenu', 'parent'=> 0, 'weight' => 0	],
    		[ 'id' => 201, 'vocabulary_id' => 16, 'name' => 'Recherche', 'parent'=> 0, 'weight' => 1	],
    		[ 'id' => 202, 'vocabulary_id' => 16, 'name' => 'Tutoriel', 'parent'=> 0, 'weight' => 2	],
    		[ 'id' => 300, 'vocabulary_id' => 17, 'name' => 'Transmission'	, 'parent'=> 0, 'weight' => 0],
    		[ 'id' => 301, 'vocabulary_id' => 17, 'name' => 'Apprenti', 'parent'=> 0, 'weight' => 1	],
    		[ 'id' => 302, 'vocabulary_id' => 17, 'name' => 'Développement', 'parent'=> 0, 'weight' => 2	],
    		[ 'id' => 303, 'vocabulary_id' => 17, 'name' => 'Soutien émotionnel', 'parent'=> 0, 'weight' => 3	],
    		[ 'id' => 304, 'vocabulary_id' => 17, 'name' => 'Changement de société', 'parent'=> 0, 'weight' => 4	],
		]);

		DB::table('options')->insert([
    		[ 'key' => 'categories_contenus_base', 'type' => 'global', 'value' => '11,12,13,14,15'	],
    		[ 'key' => 'categories_si_non_disciplinaire', 'type' => 'global', 'value' => '16,17'	],
    		[ 'key' => 'categorie_disciplinaire', 'type' => 'global', 'value' => '11'	],
    	]);
	}

}

