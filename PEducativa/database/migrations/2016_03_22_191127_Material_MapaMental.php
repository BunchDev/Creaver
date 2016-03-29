<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialMapaMental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('material_mapamental', function (Blueprint $table) {
           
            $table->increments('idMaterial');
            $table->integer('fk_idMapaMental')->unsigned();
            $table->string('url');
            $table->integer('tipo');
            $table->string('icon');
            $table->timestamps();
            }); 

        Schema::table('material_mapamental', function($table) {
      
            $table->foreign('fk_idMapaMental')->references('idMapaMental')->on('mapamental')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('material_mapamental');
    }
}
