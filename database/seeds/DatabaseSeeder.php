<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DroitsRolesMenusTableSeeder::class);
        $this->call(TaxonomiesTableSeeder::class);
        $this->call(ContenusTableSeeder::class);
    }
}
