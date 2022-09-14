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
            $table->boolean('tem_documento')->default(false);
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('doenca_atual')->nullable();
            $table->char('genero')->nullable();
            $table->string('faixa_idade')->nullable();
            $table->string('tempo_rua')->nullable();
            $table->boolean('aceita_foto')->nullable();
            $table->json('condicao_fisica')->nullable();
            $table->string('path_foto')->nullable();
            $table->boolean('deseja_ajuda')->nullable();
            $table->bigInteger('passagem_policia_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('passagem_policia_id')->references('id')->on('passagem_policias');
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
