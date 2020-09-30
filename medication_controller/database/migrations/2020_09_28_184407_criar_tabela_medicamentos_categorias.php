<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaMedicamentosCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos_categorias', function (Blueprint $table) {
            $table->integer('medicamentos_id')->unsigned();
            $table->integer('categorias_id')->unsigned();

            $table->primary(['medicamentos_id','categorias_id']);

            $table->foreign('medicamentos_id')->references('id')->on('medicamentos')->cascadeOnDelete();
            $table->foreign('categorias_id')->references('id')->on('categorias')->cascadeOnDelete();
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
    }
}
