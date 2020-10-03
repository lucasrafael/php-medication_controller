<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CriarTabelaUsuarios
 * @author lucasrafael
 */
class CriarTabelaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->nullable(false);
            $table->string('login')->nullable(false)->unique();
            $table->string('email')->nullable(false)->unique();
            $table->string('password')->nullable(false);

            $table->timestamps();

            $table->index('login');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
