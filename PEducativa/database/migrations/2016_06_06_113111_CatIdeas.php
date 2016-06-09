<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatIdeas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abp_CategorizacionIdeas', function (Blueprint $table) {

               $table->increments('idCategorizacionIdeas');
               $table->integer('fk_idAbp')->unsigned();
               $table->integer('fk_idAlumno')->unsigned();
               $table->string('NombreCategoria');
               $table->string('ColorCategoria'); 
                
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_CategorizacionIdeas', function($table) {
      
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
        Schema::drop('abp_CategorizacionIdeas');
    }
}
