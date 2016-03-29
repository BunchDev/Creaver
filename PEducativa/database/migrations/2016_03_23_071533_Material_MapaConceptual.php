<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialMapaConceptual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('material_mapaconceptual', function (Blueprint $table) {
           
            $table->increments('idMaterial');
            $table->integer('fk_idMapaConceptual')->unsigned();
            $table->string('url');
            $table->integer('tipo');
            $table->string('icon');
            $table->timestamps();
            }); 

        Schema::table('material_mapaconceptual', function($table) {
      
            $table->foreign('fk_idMapaConceptual')->references('idMapaConceptual')->on('mapaconceptual')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('material_mapaconceptual');
    }
}
