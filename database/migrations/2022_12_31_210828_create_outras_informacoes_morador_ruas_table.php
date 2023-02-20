<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutrasInformacoesMoradorRuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outras_informacoes_morador_ruas', function (Blueprint $table) {
            $table->id();
            $table->boolean('alguma_doenca')->default(false);
            $table->string('doenca_atual')->nullable();
            $table->text('relatorio_medico')->nullable();
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
        Schema::dropIfExists('outras_informacoes_morador_ruas');
    }
}
