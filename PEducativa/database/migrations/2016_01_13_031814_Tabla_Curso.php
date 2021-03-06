<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('curso', function (Blueprint $table) {
            $table->increments('idCurso');
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->integer('idCatedratico')->unsigned();
            $table->string('avatar')->default('view_quilt');
            $table->integer('Estatus');
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
        Schema::drop('curso');
    }
}
