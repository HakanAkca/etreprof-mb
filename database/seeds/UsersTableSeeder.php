<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


		$users = [
			['name' => 'Damien RAVÉ', 'role_id' => 6, 'email' => 'contact@damienrave.fr', 'password' => bcrypt('mortimer')],
			['name' => 'nathalie', 'role_id' => 5, 'email' => 'nathalie@damienrave.fr', 'password' => bcrypt('test')],


		];

    	foreach ($users as $user)
    	{
    		DB::table('users')->insert($user);
		}


    }
}
