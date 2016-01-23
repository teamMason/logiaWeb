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
           
                $table->enum('grado', ['APRENDIZ','COMPANERO', 'MAESTRO', 'PAST MASTER'])->nullable();;
                $table->string('mlibre');
                $table->enum('voto', ['PERMANENTE','TRANSITORIO', 'VOZ NO COTO', 'PAST MASTER', 'NO MIEMBRO'])->nullable();;
                $table->string('telefono');
                $table->string('telefonoCel');
                $table->string('email')->nullable();
                $table->integer('id_taller')->index();
                $table->enum('estado', ['ACTIVO', 'BAJA', 'RADIADO'])->nullable();;


                
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
