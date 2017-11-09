<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Droit;
use Illuminate\Support\Facades\Cache;

class InsertDroitsModifierAvis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        $droits = [
            ['groupe' => 'Contenus', 'code' => 'modifier_tous_avis', 'description' => 'Modifier tous les avis']
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
        $droits = Droit::whereIn('code', ['modifier_tous_avis'])->get();
        foreach ($droits as $droit)
        {
            $droit->roles()->detach();
            $droit->delete();
        }
        
    }
}
