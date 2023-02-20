<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parceiros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf_cnpj');
            $table->bigInteger('tipo_parceiro_id')->unsigned();
            $table->integer('quantidade_vagas')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone_principal')->nullable();
            $table->string('telefone_secundario')->nullable();
            $table->boolean('disponivel')->default(false);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->foreign('tipo_parceiro_id')->references('id')->on('tipo_parceiros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parceiros');
    }
}
