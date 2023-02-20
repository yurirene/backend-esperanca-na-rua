<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_parametros', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->bigInteger('parametro_id')->unsigned();
            $table->timestamps();

            $table->foreign('parametro_id')->references('id')->on('parametros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valores_parametros');
    }
}
