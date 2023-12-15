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
        Schema::table('campañas', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk-users-campañas')->references(['id'])->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campañas', function (Blueprint $table) {
            $table->dropForeign(['fk-users-campañas']);
        });
    }
};
