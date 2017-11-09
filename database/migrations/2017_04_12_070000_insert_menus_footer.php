<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Droit;
use Illuminate\Support\Facades\Cache;

class InsertMenusFooter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $droit = Droit::where('code', 'acces_front')->first()->id;


        $menus = [
            [600, 'Pied de page 1', '#footer1', null],
                [null, 'Qui sommes-nous ?', '/page/qui-sommes-nous', 600],
                [null, 'Contactez-nous', 'mailto:contact@etreprof.fr', 600],
                [null, 'Rejoignez-nous', '/page/rejoignez-nous', 600],
            [700, 'Pied de page 2', '#footer2', null],
                [null, 'Mentions légales', '/page/mentions-legales', 700],
                [null, 'Contactez-nous', '/page/cookies', 700],
                [null, 'CGU', '/page/cgu', 700],
                [null, 'Confidentialite', '/page/confidentialite', 700],
            [800, 'Pied de page 3', '#footer3', null],
                [null, 'Accueil', '/', 800],
                [null, 'Explorez', '/explorer', 800],
                [null, 'Quel·le prof êtes-vous', 'http://diagnostic.etreprof.fr/', 800],
                [null, 'Le dossier', '/dossier/actuel', 800],
                [null, 'S\'inscrire', '/inscription', 800],

        ];

        foreach ($menus as $menu)
        {
            DB::table('menus')->insert([
                'id' => $menu[0],
                'text' => $menu[1],
                'url' => $menu[2],
                'parent_id' => $menu[3],
                'droit_id' => $droit
            ]);
        }

        $blocs = [
            ['footer-col1', 'Pied de page 1', '<a href="/"><img src="/img/logo-violet.png" alt="Accueil"></a>'],
            ['footer-col2', 'Pied de page 2', '<h3>L\'ASSOCIATION</h3>'], 
            ['footer-col3', 'Pied de page 3', '<h3>LE SITE</h3>'], 
            ['footer-col4', 'Pied de page 4', '<h3>NAVIGATION</h3>'], 
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
        DB::table('menus')->whereIn('id', [600,700,800])->delete();
        DB::table('menus')->whereIn('parent_id', [600,700,800])->delete();
        DB::table('articles')->where('type', 'block')->whereIn('url', ['footer-col1','footer-col2','footer-col3','footer-col4'])->delete();
        Cache::forget('blocs');
    }
}
