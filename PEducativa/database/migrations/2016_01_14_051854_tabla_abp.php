<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAbp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abp', function (Blueprint $table) {
            $table->increments('idABP');
            $table->string('Contexto');
            $table->string('problematica');
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
        Schema::drop('abp');
    }
}
