<?php
//use Taxonomy;
//use Devfactory\Taxonomy\Models\TermRelation;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

use Illuminate\Database\Seeder;

class TaxonomiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('terms')->delete();
		DB::table('vocabularies')->delete();
		DB::table('term_relations')->delete();

        $taxonomies = [

			 'Discipline' =>  [ 'Français', 'Mathématiques', 'Histoire et géographie', 'Langues vivantes', 'Enseignement moral et civique', 'Sciences et technologies','Arts','E.P.S.'],
			 'Thématiques' =>  [ 'Gestion de classe', 'Communauté éducative', 'Développement personnel', 'Documents de référence', 'Initiatives ailleurs'],
			 'Niveau de classe' =>  [ 'Maternelle', 'Elémentaire' => [ 'CP','CE1','CE2','CM1','CM2'],'Collège' => ['6e','5e','4e','3e'],'Lycée' => ['2nde','1ère','Terminale','Bac Pro']],
		];
    	foreach ($taxonomies as $vocabulaire => $termes)
    	{
    		//dd($vocabulaire);
    		$voc = Vocabulary::create(['name' => $vocabulaire]);
			$i = 0;
    		foreach($termes as $key => $terme)
    		{
    			if (is_array($terme))
    			{
    				$term = new Term([
    					'name' => $key,
    					'parent' => 0,
    					'vocabulary_id' => $voc->id,
    					'weight' => $i++
    				]);
    				$term->save();
    				$j = 0;
					foreach	($terme as $terme_niv2)
					{
						$term_2 = new Term([
    						'name' => $terme_niv2,
    						'parent' => $term->id,
    						'vocabulary_id' => $voc->id,
    						'weight' => $j++
    					]);
    					$term_2->save();
					}
				}
				else
				{

    				$term = new Term([
    					'name' => $terme,
    					'parent' => 0,
    					'vocabulary_id' => $voc->id,
    					'weight' => $i++
    				]);
    				$term->save();
    				//print_r($term);
				}
			}
		}
    }
}
