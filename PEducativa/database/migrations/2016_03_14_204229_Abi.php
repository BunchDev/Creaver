<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Abi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abi', function (Blueprint $table) {
           
            $table->increments('idAbi');
            $table->text('generador');
            $table->integer('tipo');
            $table->integer('fk_idActividad')->unsigned();
            $table->timestamps();
            }); 

        Schema::table('abi', function($table) {
      
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
        Schema::drop('abi');
    }
}
