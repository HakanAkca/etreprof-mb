<?php

use Illuminate\Database\Seeder;

class V2017_03_27_170000_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('droits')->insert([
    		[ 'code' => 'acces_front', 'groupe' => 'Site public', 'description' => 'Accéder au site public (front office)'],
    	]);
	}

}

