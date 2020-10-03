<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CriarTabelaMarcas
 * @author lucasrafael
 */
class CriarTabelaMarcas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Marcas { id, nome }
        Schema::create('marcas', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('nome', 30)->unique()->nullable(false);

            $table->timestamps();

            $table->index('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamentos');
        Schema::dropIfExists('marcas');
    }
}
