<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialesResumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_resumen', function (Blueprint $table) {
           
            $table->increments('idMaterial');
            $table->integer('fk_idResumen')->unsigned();
            $table->string('url');
            $table->integer('tipo');
            $table->string('icon');
            $table->timestamps();
            }); 

        Schema::table('material_resumen', function($table) {
      
            $table->foreign('fk_idResumen')->references('idResumen')->on('resumen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('material_resumen');
    }
}
