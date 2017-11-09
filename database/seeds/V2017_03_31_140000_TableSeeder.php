<?php

use Illuminate\Database\Seeder;

class V2017_03_31_140000_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('options')->insert([
    		[
    			'key' => 'images_defaut',
    			'value' => 'http://test.etreprof.fr/photos/shares/default/livre_ouvert.jpg?timestamp=1490952739',
    			'type' => 'global'
    		],
    	]);
	}

}

