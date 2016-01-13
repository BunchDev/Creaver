<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaComentarioPropuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('comentario_propuesta', function (Blueprint $table) {
            $table->increments('idComentarioPropuesta');
            $table->string('Contenido');
            $table->integer('fk_idPropuesta')->unsigned();
            $table->integer('idUsuario')->unsigned();
            
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
       Schema::drop('comentario_propuesta');
    }
}
