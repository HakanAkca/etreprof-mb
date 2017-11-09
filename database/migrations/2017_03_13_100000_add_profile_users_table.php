<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nom',64)->after('nb_contributions')->default('');
            $table->string('prenom',64)->after('nom')->default('');
            $table->string('codepostal',20)->after('prenom')->default('');
            $table->string('pays',20)->after('codepostal')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('nom');
			$table->dropColumn('prenom');
			$table->dropColumn('codepostal');
			$table->dropColumn('pays');
		});
    }
}
