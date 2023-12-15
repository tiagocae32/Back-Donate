<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampañasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campañas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descripcion');
            $table->integer('fondos_a_recaudar');
            $table->integer('fondos_recaudado_actual')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campañas');
    }
}
