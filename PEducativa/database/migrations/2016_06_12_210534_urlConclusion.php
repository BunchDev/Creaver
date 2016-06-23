<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UrlConclusion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('abp_UrlConclusion', function (Blueprint $table) {

               $table->increments('idUrlConclusion');
               $table->integer('fk_idConclusion')->unsigned();    
               $table->string('url');  
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_UrlConclusion', function($table) {
      
            $table->foreign('fk_idConclusion')->references('idConclusion')->on('abp_Conclusion')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abp_UrlConclusion');
    }

}
