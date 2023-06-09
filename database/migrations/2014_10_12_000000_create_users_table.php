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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',20);
            $table->string('email', 30);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contraseña', 100);
            $table->bigInteger("rol_id")->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(["nombre", "email"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
