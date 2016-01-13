<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('actividad', function (Blueprint $table) {
            $table->increments('idActividad');
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->integer('fk_idCurso')->unsigned();
            $table->integer('idTecnica');
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
       Schema::drop('actividad');
    }
}
