<?php

use Illuminate\Database\Seeder;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

class V2017_03_29_140000_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('vocabularies')->insert([
    		[ 'id' => 18, 'shortname' => 'objectifs', 'name' => 'Objectifs'],
    		[ 'id' => 19, 'shortname' => 'groupe_individuel', 'name' => 'Groupe / Individuel'],
    		[ 'id' => 20, 'shortname' => 'usage', 'name' => 'Usage'],
    	]);

		Vocabulary::where('name', 'Discipline')->update(['shortname' => 'discipline']);
		Vocabulary::where('name', 'Thématique')->update(['shortname' => 'thematique']);
		Vocabulary::where('name', 'Niveau de classe')->update(['shortname' => 'niveau']);
		Vocabulary::where('name', 'Type de contenu')->update(['shortname' => 'format']);
		Vocabulary::where('name', 'Théorique/pratique')->update(['shortname' => 'theorique_pratique']);
		Vocabulary::where('name', 'Recommandation')->update(['shortname' => 'recommandation']);
		Vocabulary::where('name', 'Positionnement/profil')->update(['shortname' => 'profil']);

    	$cats = [
			'objectifs' => ['Centrés', 'Transversaux'],
			'groupe_individuel' => ['Activité de groupe', 'Activité individuelle'],
			'usage' => ['Evaluation', 'Activité d’entrainement', 'Activité rituelle', 'Situation de recherche ou manipulation', 'Outil collectif (affichage...)', 'Aide méthodologique (grille de relecture...)'],
    	];

    	foreach ($cats as $cat => $terms)
    	{
    		$voc = Vocabulary::where('shortname', $cat)->first();
			$i = 0;
    		foreach ($terms as $term)
    		{
    			DB::table('terms')->insert([
					'name' => $term,
    				'parent' => 0,
    				'vocabulary_id' => $voc->id,
    				'weight' => $i++
    			]);
			}
    	}
	}

}

