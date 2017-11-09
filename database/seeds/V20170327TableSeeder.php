<?php

use Illuminate\Database\Seeder;

class V20170327TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	/*DB::table('vocabularies')->insert([
    		[ 'id' => 16, 'name' => 'Recommandation' ],
    		[ 'id' => 17, 'name' => 'Positionnement/profil' ],
    	]);*/

		/*DB::table('terms')->insert([
    		[ 'id' => 200, 'vocabulary_id' => 16, 'name' => 'Recommander ce contenu', 'parent'=> 0, 'weight' => 0	],

		]);*/

		DB::table('options')->insert([
    		[ 'key' => 'categories_contenus_base', 'type' => 'global', 'value' => '11,12,13,14,15'	],
    		[ 'key' => 'categories_si_thematique', 'type' => 'global', 'value' => '16,17'	],
    		[ 'key' => 'categorie_discipline', 'type' => 'global', 'value' => '11'	],
    		[ 'key' => 'categorie_thematique', 'type' => 'global', 'value' => '12'	],
    	]);
	}

}

