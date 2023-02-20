<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParceirosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parceiros_usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parceiro_id')->unsigned();
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('parceiro_id')->references('id')->on('parceiros');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parceiros_usuarios');
    }
}
