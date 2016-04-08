<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla Miembro
            Schema::create('miembros', function($table)
            {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->string('nombre');
                $table->string('apellido');
                $table->enum('cargo', ['VENERABLE MAESTRO',
                    'PRIMER VIGILANTE',
                    'SEGUNDO VIGILANTE',
                    'ORADOR',
                    'SECRETARIO',
                    'TESORERO',
                    'MTO DE CEREMONIAS',
                    'PRIMER EXPERTO',
                    'SEGUNDO EXPERTO',
                    'SIN CARGO'])->nullable();
           
                $table->enum('grado', ['APRENDIZ','COMPANERO', 'MAESTRO', 'PAST MASTER'])->nullable();
                $table->enum('mlibre',['SI','NO'])->nullable();
                $table->enum('voto', ['PERMANENTE','TRANSITORIO', 'VOZ NO VOTO', 'NO MIEMBRO']);
                $table->string('telefono')->nullable();
                $table->string('telefonoCel')->nullable();
                $table->string('email')->nullable();
                $table->string('profesion')->nullable();
                $table->enum('estado', ['ACTIVO', 'BAJA', 'RADIADO'])->nullable();
                $table->date('iniciación')->nullable();
                $table->date('aumento')->nullable();
                $table->date('exaltacion')->nullable();
                $table->date('fecha_baja')->nullable();
                $table->timestamps();
                $table->integer('id_taller');



                //$table->foreign('id_taller')->references('id')->on('taller');
                
                
                
                //$table->timestamps();
            });

           /*
                Schema::table('miembro', function($table) {
                $table->integer('id_taller')->unsigned();
                $table->foreign('id_taller')->references('id')->on('taller');
          
            });
            */

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('miembros');
    }
}
