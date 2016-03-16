<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MaterialesAbi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
          Materiales_abi 
        idMaterial 
        idAbi (foreing key)
        url 
        */

         Schema::create('materiales_abi', function (Blueprint $table) {
           
            $table->increments('idMaterial');
            $table->integer('fk_idAbi')->unsigned();
            $table->string('url');
            $table->timestamps();
            }); 

        Schema::table('materiales_abi', function($table) {
      
            $table->foreign('fk_idAbi')->references('idAbi')->on('abi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materiales_abi');
    }
}
