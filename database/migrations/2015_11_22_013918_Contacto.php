<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nombre',255);           
            $table->string('email',100);
            $table->string('telefono');
            $table->text('mensaje');
            $table->string('leido');           
            $table->timestamps();
        
        });  //
        //
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
