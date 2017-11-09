<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Droit;
use Illuminate\Support\Facades\Cache;

class InsertOptionDestinataires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function ($table) {
            $table->string('description', 1000)->after('value')->nullable();
        });

        $options = [

            ['sos_destinataires', 'liste des destinataires des messages SOS', 'contact@etreprof.fr'],
            ['feedback_destinataires', 'liste des destinataires des messages feedback', 'contact@etreprof.fr'],
            ['contact_destinataires', 'liste des destinataires des messages contact', 'contact@etreprof.fr'],
        ];

        foreach ($options as $option)
        {
            DB::table('options')->insert([
                'key' => $option[0],
                'type' => 'global',
                'value' => $option[2],
                'description' => $option[1]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function($table) {
            $table->dropColumn('description');
        });
        DB::table('options')->whereIn('key', ['sos_destinataires', 'feedback_destinataires', 'contact_destinataires'])->delete();
    }
}
