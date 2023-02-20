<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentificacaoMoradorRuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identificacao_morador_ruas', function (Blueprint $table) {
            $table->id();
            $table->boolean('tem_documento')->default(false);
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cidade_natal')->nullable();
            $table->string('estado_natal')->nullable();
            $table->string('nome_familiar')->nullable();
            $table->string('contato_familiar')->nullable();
            $table->uuid('morador_rua_id');
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
        Schema::dropIfExists('identificacao_morador_ruas');
    }
}
