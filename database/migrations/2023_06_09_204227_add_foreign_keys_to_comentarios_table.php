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
        Schema::table('comentarios', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk-comentarios-users')->references(['id'])->on('users');
            $table->foreign(['campaña_id'], 'fk-comentarios-campañas')->references(['id'])->on('campañas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comentarios', function (Blueprint $table) {
            $table->dropForeign(["fk-comentarios-users", "fk-comentarios-users"]);
        });
    }
};
