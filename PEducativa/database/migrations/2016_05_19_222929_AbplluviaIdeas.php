<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AbplluviaIdeas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
         Schema::create('abp_lluviaIdeas', function (Blueprint $table) {

               $table->increments('idAbplluviaIdeas');
               $table->integer('fk_idAbp')->unsigned();
               $table->integer('fk_idAlumno')->unsigned();
               $table->string('Ideas'); 
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_lluviaIdeas', function($table) {
      
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
        Schema::drop('abp_lluviaIdeas');
    }
}
