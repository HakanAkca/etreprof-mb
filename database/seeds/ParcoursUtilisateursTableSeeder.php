<?php

use Illuminate\Database\Seeder;

class ParcoursUtilisateursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	$users = 10000;
    	$contenus_par_user = 10;
    	
		$chunk = 1000;
    	$iterations = $users * $contenus_par_user / $chunk; 


    	for ($i = 0; $i < $iterations; $i++)
    	{
    		$parcours = [];
    		for ($j = 0; $j < $chunk; $j++)
    		{
    			$int= mt_rand(strtotime('-1 year'),time());
    			$parcours[] = [
    				'user_id' => rand(1,10),
    				'contenu_id' => rand(1,1200),
    				'date' => date("Y-m-d H:i:s",$int)
    			];
    		}

    		DB::table('parcours_utilisateurs')->insert($parcours);

    	}


    }
}
