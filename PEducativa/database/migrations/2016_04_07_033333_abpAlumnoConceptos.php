<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AbpAlumnoConceptos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abp_conceptos', function (Blueprint $table) {

               $table->increments('idAbpConcepto');
               $table->integer('fk_idAbp')->unsigned();
               $table->integer('fk_idAlumno')->unsigned();
               $table->string('palabra');
               $table->text('concepto');
               $table->string('fuente'); 
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_conceptos', function($table) {
      
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
        Schema::drop('abp_conceptos');
    }
}
