<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CriarTabelaCategorias
 * @author lucasrafael
 */
class CriarTabelaCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Categorias { id, nome }
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('nome', 50)->unique()->nullable(false);

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
        Schema::dropIfExists('medicamentos_categorias');
        Schema::dropIfExists('categorias');
    }
}
