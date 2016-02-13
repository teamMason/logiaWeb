<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rubros', function($table)
            {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('capitas');
                $table->integer('iniciaciones');
                $table->integer('regularizaciones');
                $table->integer('afiliaciones_com');
                $table->integer('afiliaciones_priv');
                $table->integer('dispensa_tramite');
                $table->integer('derechos_exalt');
                $table->integer('credencial');
                $table->integer('diplomas');
                $table->integer('liturgia_a');
                $table->integer('liturgia_c');
                $table->integer('liturgia_m');
                $table->integer('status');
                $table->integer('constitucion');
                $table->integer('codigos_penales');
                $table->integer('activacion_logias');
                $table->integer('aumento_sal');
                $table->integer('cuota_ext');
                $table->integer('derechos_logia');

                
                                                
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //dar de baja la tabla
        Schema::drop('rubros');
    }
}
