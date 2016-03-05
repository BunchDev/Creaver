<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Actividad extends Migration
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
            $table->integer('idTecnica')->unsigned();
            $table->integer('tipo_tecnica');
            $table->integer('status');
            $table->date('vencimiento');
            $table->timestamps();
        });

       Schema::table('actividad', function($table) {
      
       $table->foreign('fk_idCurso')->references('idCurso')->on('curso')->onDelete('cascade');
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