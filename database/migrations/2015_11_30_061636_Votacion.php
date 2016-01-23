<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Votacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votaciones', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->text('estatus');           
            $table->text('comentarios');           
            $table->string('id_solicitud');
            $table->text('id_taller');   
            
        
        });  //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
