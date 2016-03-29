<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MapaConceptual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapa_conceptual', function (Blueprint $table) {
           
            $table->increments('idMapaConceptual');
            $table->text('instruccion');
            $table->integer('fk_idActividad')->unsigned();
            $table->timestamps();
            }); 

        Schema::table('mapa_conceptual', function($table) {
      
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
        Schema::drop('mapa_conceptual');
    }
}
