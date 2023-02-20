<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PerfilRota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_rota', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('perfil_id')->unsigned();
            $table->bigInteger('rota_id')->unsigned();
            $table->timestamps();

            $table->foreign('perfil_id')->references('id')->on('perfis');
            $table->foreign('rota_id')->references('id')->on('rotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_rota');
    }
}
