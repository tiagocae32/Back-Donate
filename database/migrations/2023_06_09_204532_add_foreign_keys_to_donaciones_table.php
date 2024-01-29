<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donaciones', function (Blueprint $table) {
            $table->foreign(['campaña_id'], 'fk-donaciones-campañas')->references(['id'])->on('campañas');
            $table->foreign(['user_id'], 'fk-donaciones-users')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donaciones', function (Blueprint $table) {
            $table->dropForeign(["fk-donaciones-campañas", "fk-donaciones-users"]);
        });
    }
};
