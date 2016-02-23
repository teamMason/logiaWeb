<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('titulo',255);
            $table->string('grado',255);
            $table->string('slug',255);
            $table->enum('editado', ['true','false']);
            $table->string('descripcion',150);
            $table->string('autor',150);

            $table->timestamps();

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
