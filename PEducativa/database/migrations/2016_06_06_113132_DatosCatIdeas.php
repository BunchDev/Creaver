<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatosCatIdeas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abp_DatosIdea', function (Blueprint $table) {

               $table->increments('idDatosIdea');
               $table->integer('fk_idCategorizacionIdeas')->unsigned();    
               $table->string('Idea');  
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_DatosIdea', function($table) {
      
            $table->foreign('fk_idCategorizacionIdeas')->references('idCategorizacionIdeas')->on('CategorizacionIdeas')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abp_DatosIdea');
    }

}
