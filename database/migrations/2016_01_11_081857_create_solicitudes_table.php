<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nombre',255);           
            $table->string('apellido',255);
            $table->string('ciudad');
            $table->string('profesion');
            $table->string('edoCivil',10);
            $table->string('ingresoMen',100);
            $table->string('telefono',20);
            $table->string('telefonoCel',20);
            $table->string('email', 100)->unique();
            $table->text('comentarios');
            $table->string('estadoSolicitud',20); // es visto o no despues de enviar la solicitus
            $table->string('estadoVotacion',20);// es visto o no mientras está en proceso de votación
            $table->string('estadoIniciacion',20);
            $table->string('estadoAlta',20);
            $table->text('check'); // array guarda el taller que ya ha votado por esa sol..
            $table->string('path',200);
            $table->integer('id_taller');
            $table->string('fechaLim');
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
