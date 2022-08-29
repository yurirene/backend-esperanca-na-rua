<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoradorRuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morador_ruas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome')->nullable();
            $table->tinyInteger('tipo_destino')->nullable();
            $table->boolean('tem_documento')->default(false);
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('doenca_atual')->nullable();
            $table->boolean('passagem_policia')->nullable();
            $table->char('genero')->nullable();
            $table->string('faixa_idade')->nullable();
            $table->integer('tempo_rua')->nullable();
            $table->string('geo_lat')->nullable();
            $table->string('geo_lon')->nullable();
            $table->boolean('aceita_foto')->nullable();
            $table->json('condicao_fisica')->nullable();
            $table->string('path_foto')->nullable();
            $table->boolean('deseja_ajuda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('morador_ruas');
    }
}
