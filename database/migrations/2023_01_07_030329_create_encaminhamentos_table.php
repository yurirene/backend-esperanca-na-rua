<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncaminhamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encaminhamentos', function (Blueprint $table) {
            $table->id();
            $table->uuid('morador_rua_id');
            $table->bigInteger('parceiro_id')->unsigned();
            $table->timestamp('recebido_em')->nullable();
            $table->timestamps();

            $table->foreign('morador_rua_id')->references('id')->on('morador_ruas')->onDelete('cascade');
            $table->foreign('parceiro_id')->references('id')->on('parceiros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encaminhamentos');
    }
}
