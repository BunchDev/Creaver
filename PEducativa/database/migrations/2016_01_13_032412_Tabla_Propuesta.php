<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPropuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
      Schema::create('propuesta', function (Blueprint $table) {
            $table->increments('idPropuesta');
            $table->string('Nombre');
            $table->string('UrlPropuesta');
            $table->integer('fk_idCurso')->unsigned();
            $table->string('Version');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('propuesta');
    }
}
