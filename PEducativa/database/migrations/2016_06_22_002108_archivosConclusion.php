<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArchivosConclusion extends Migration
{   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('abp_ArchivosConclusion', function (Blueprint $table) {

               $table->increments('idArchivosConclusion');
               $table->integer('fk_idConclusion')->unsigned();    
               $table->binary('archivos');  
               $table->timestamps();
        });

        //creacion de las llaves foraneas
         Schema::table('abp_ArchivosConclusion', function($table) {
      
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
        Schema::drop('abp_ArchivosConclusion');
    }

}
