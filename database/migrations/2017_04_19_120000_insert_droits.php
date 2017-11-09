<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Droit;
use Illuminate\Support\Facades\Cache;

class InsertDroits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        $droits = [
            ['groupe' => 'Contenus', 'code' => 'contenus_editeur_full', 'description' => 'Utiliser l\'éditeur Full HTML (+ insertion d\'images)'],
            ['groupe' => 'Contenus', 'code' => 'modifier_tous_contenus', 'description' => 'Modifier tous les contenus']
        ];

        foreach ($droits as $droit)
        {
            $id = DB::table('droits')->insertGetId($droit);
            DB::table('droits_roles')->insert(['role_id' => 5, 'droit_id' => $id]);
        }
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $droits = Droit::whereIn('code', ['contenus_editeur_full', 'modifier_tous_contenus'])->get();
        foreach ($droits as $droit)
        {
            $droit->roles()->detach();
            $droit->delete();
        }
        
    }
}
