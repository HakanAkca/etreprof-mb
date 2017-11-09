<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->truncate();

        $roles = [
			[ 'code' => '-', 'nom' => 'Aucun' ],
			[ 'code' => 'Membre non activé', 'nom' => 'Membre (compte non activé)' ],
			[ 'code' => 'Membre', 'nom' => 'Membre (compte activé)' ],
			[ 'code' => 'Tête Chercheuse', 'nom' => 'Tête Chercheuse' ],
			//[ 'code' => 'Validant', 'nom' => 'Validant' ],
			[ 'code' => 'SuperAdmin', 'nom' => 'Super-Admin' ],
		];
    	foreach ($roles as $role)
    	{
    		DB::table('roles')->insert($role);
		}
    }
}
