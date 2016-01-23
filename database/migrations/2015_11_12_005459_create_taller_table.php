<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('taller', function($table)
            {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->string('nombreTaller', 100);
                $table->string('direccion', 100);
                $table->string('ciudad', 50);
                $table->string('dia', 15);
                $table->integer('hora');
                
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('taller');
    }
}
