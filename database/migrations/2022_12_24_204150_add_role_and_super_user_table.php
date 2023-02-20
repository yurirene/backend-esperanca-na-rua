<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleAndSuperUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_super')->default(false);
            $table->bigInteger('perfil_id')->unsigned()->nullable();

            $table->foreign('perfil_id')->references('id')->on('perfis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_super', 'perfil_id']);
            $table->dropConstrainedForeignId('perfil_id');
        });
    }
}
