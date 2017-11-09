<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Droit;
use Illuminate\Support\Facades\Cache;

class InsertRecommandationsTitre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        $blocs = [
            ['sidebar-recommandations-titre', 'Titre recommandations', 'On a pensé à vous']
        ];
        foreach ($blocs as $bloc)
        {
            DB::table('articles')->insert([
                'type' => 'block',
                'status' => 'published',
                'url' => $bloc[0],
                'title' => $bloc[1],
                'content' => $bloc[2]
            ]);
        }
        Cache::forget('blocs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('articles')->where('type', 'block')->whereIn('url', ['sidebar-recommandations-titre'])->delete();
        Cache::forget('blocs');
    }
}
