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
            $table->char('genero')->nullable();
            $table->string('faixa_etaria')->nullable();
            $table->string('tempo_rua')->nullable();
            $table->string('limpeza')->nullable();
            $table->string('sobriedade')->nullable();
            $table->string('path_foto')->nullable();
            $table->string('passagem_policia')->nullable();
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
