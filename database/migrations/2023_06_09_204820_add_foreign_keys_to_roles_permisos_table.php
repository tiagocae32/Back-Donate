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
        Schema::table('roles_permisos', function (Blueprint $table) {
            $table->foreign(['rol_id'], 'fk-roles_permisos-rol')->references(['id'])->on('roles');
            $table->foreign(['permiso_id'], 'fk-roles_permisos-permiso')->references(['id'])->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_permisos', function (Blueprint $table) {
            $table->dropForeign(['fk-roles_permisos-rol', 'fk-roles_permisos-permiso']);
        });
    }
};
