<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAbp extends Migration
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
            $table->integer('fk_idActividad')->unsigned();;
            $table->timestamps();
            }); 

    Schema::table('abp', function($table) {
      
       $table->foreign('fk_idActividad')->references('idActividad')->on('actividad')->onDelete('cascade');
   });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abp');
    }
}
