<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AbpPlanteamientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abp_planteamientos', function (Blueprint $table) {

               $table->increments('idAbpPlanteamientos');
               $table->integer('fk_idAbp')->unsigned();
               $table->integer('fk_idAlumno')->unsigned();
               $table->string('Planteamiento'); 
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_planteamientos', function($table) {
      
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
        Schema::drop('abp_planteamientos');
    }
}
