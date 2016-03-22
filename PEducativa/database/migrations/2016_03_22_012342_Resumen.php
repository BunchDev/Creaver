<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Resumen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('resumen', function (Blueprint $table) {
           
            $table->increments('idResumen');
            $table->text('instruccion');
            $table->integer('fk_idActividad')->unsigned();
            $table->timestamps();
            }); 

        Schema::table('resumen', function($table) {
      
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
        Schema::drop('resumen');

            }
}
