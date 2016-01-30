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
    Schema::create('abp', function (Blueprint $table) {
            $table->increments('idABP');
            $table->string('Contexto');
            $table->string('problematica');
            $table->timestamps();
            }); 
      Schema::create('actividad', function (Blueprint $table) {
            $table->increments('idActividad');
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->integer('fk_idCurso')->unsigned();
            $table->integer('idTecnica')->length(10)->unsigned();
            $table->integer('tipo_tecnica');
            $table->timestamps();
        });

       Schema::table('actividad', function($table) {
       $table->foreign('idTecnica')->references('idABP')->on('abp')->onDelete('cascade');
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
