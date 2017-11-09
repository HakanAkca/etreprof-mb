<?php

use Illuminate\Database\Seeder;

class ContenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$contenus = [];
		$row = 1;
		if (($handle = fopen(database_path('/seeds/import-contenus.csv'), "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	if ($row++ == 1) continue;

		    	$duree_secondes = 0;
		    	list($d, $f) = sscanf($data[6], '%d %s');
		    	switch ($f)
		    	{
					case 'minutes' :
					case 'minute' :
					case 'min' :
						$duree_secondes = $d*60;
						break;

					case 'h' :
					case 'heures' :
					case 'heure' :
						$duree_secondes = $d*3600;
						break;
				}

		    	$contenus[] = [
		    		'titre' => $data[2],
		    		'propose_par_id' => (strtolower($data[0]) == 'nathalie') ? 2 : 0,
		    		'url' => $data[1],
		    		'description' => $data[7],
		    		'data' => json_encode($data),
		    		'auteur' => '',
		    		'duree_secondes' => $duree_secondes

		    	];

		        //echo "<p> $num fields in line $row: <br /></p>\n";
		    }
		    fclose($handle);
		}

		print_r($contenus);


    	DB::table('contenus')->insert($contenus);

    	$contenus = Contenu::all();
    	foreach ($contenus as $contenu)
    	{
			if ($contenu->etat != 'efface')
			{
				$data = json_decode($contenu->data);
				$types = Taxonomy::getVocabularyByName('Type de contenu');

				$type = trim(strtolower($data[5]));

				$terme = $types->terms()->where('name', $type)->first();

				if (!$terme)
				{
					print 'Créer le terme ' . $type;
					$terme = Taxonomy::createTerm($types->id, $type);
				}
				$contenu->addTerm($terme->id);
				//dd($terme);
			}

			if (!$contenu->tags AND $contenu->data)
			{
				$data = json_decode($contenu->data);
				$tags = str_replace([';','/','(', ')'],[',',',',',',','], $data[4]);
				$tags = str_replace([' ,',', '],[',',','], $tags);
				$tags = str_replace(["\r","\n"],[',',','], $tags);

				$tags = str_replace(['pratiq,','pra,','prat,'],['pratique,','pratique,','pratique,'], $tags);
				$tags = str_replace(['théo,','théor,','théori,','théoriq,'],['théorique,','théorique,','théorique,','théorique,'], $tags);
				$tags = str_replace([',,',',,,'],[',',','], $tags);
				$tags = str_replace([',,',',,,'],[',',','], $tags);
				//$tags = mb_strtolower($tags);
				$contenu->tags = trim($tags);
				print "\r\n" . $contenu->id . ' : ' . $contenu->tags;
				$contenu->save();
			}
		}

    }
}
