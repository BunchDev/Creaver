<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AbpEstudioIndependiente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
         Schema::create('abp_EstudioIndependiente', function (Blueprint $table) {

               $table->increments('idEstudioIndependiente');
               $table->integer('fk_idAbp')->unsigned();
               $table->integer('fk_idAlumno')->unsigned();
               $table->string('EstudioIndependiente'); 
               $table->string('Fuente'); 
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_EstudioIndependiente', function($table) {
      
            $table->foreign('fk_idAbp')->references('idAbp')->on('abp')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abp_EstudioIndependiente');
    }
}