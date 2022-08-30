<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacaos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('morador_rua_id');
            $table->string('geo_lat')->nullable();
            $table->string('geo_lon')->nullable();
            $table->bigInteger('status_solicitacao_id')->unsigned();
            $table->bigInteger('tipo_destino_id')->unsigned();
            $table->uuid('atendente_id')->nullable();
            $table->uuid('solicitante_id');
            $table->timestamps();

            $table->foreign('morador_rua_id')->references('id')->on('morador_ruas');
            $table->foreign('atendente_id')->references('id')->on('users');
            $table->foreign('solicitante_id')->references('id')->on('users');
            $table->foreign('status_solicitacao_id')->references('id')->on('status_solicitacaos');
            $table->foreign('tipo_destino_id')->references('id')->on('tipo_destinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacaos');
    }
}
