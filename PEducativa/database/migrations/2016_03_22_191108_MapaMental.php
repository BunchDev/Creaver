<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MapaMental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('mapamental', function (Blueprint $table) {
           
            $table->increments('idMapaMental');
            $table->text('instruccion');
            $table->integer('fk_idActividad')->unsigned();
            $table->timestamps();
            }); 

        Schema::table('mapamental', function($table) {
      
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
        Schema::drop('mapamental');
    }
}
