<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AInvertida extends Migration
{ 

/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulaInvertida', function (Blueprint $table) {
            $table->increments('idAi');
            $table->string('nombreVideo');
            $table->string('url');
            $table->string('instruccion');
            $table->integer('fk_idActividad')->unsigned();
            $table->timestamps();
            }); 

        Schema::table('aulaInvertida', function($table) {
      
            $table->foreign('fk_idActividad')->references('idActividad')->on('actividad')->onDelete('cascade');
        });
   
    }

    public function down()
    {

     Schema::drop('aulaInvertida');
    }


}
