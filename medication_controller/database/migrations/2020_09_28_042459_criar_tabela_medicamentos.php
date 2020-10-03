<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CriarTabelaMedicamentos
 * @author lucasrafael
 */
class CriarTabelaMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('nome', 50)->nullable(false);
            $table->string('descricao', 100)->nullable(false);
            $table->string('prescricao', 200)->nullable(true);
            $table->date('validade')->nullable(false);
            $table->integer('quantidade')->nullable(false);

            $table->timestamps();

            $table->integer('marca_id')->nullable(false)->unsigned();
            $table->foreign('marca_id')
                ->references('id')
                ->on('marcas');

            $table->index('validade');
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
    }
}
