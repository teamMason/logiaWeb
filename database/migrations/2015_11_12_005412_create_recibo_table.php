<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function($table)
            {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('id_taller')->index();
                $table->integer('cant_capitas');
                $table->integer('capitas_pagar');//sadfasdf
                $table->integer('monto_capitas');
                $table->integer('cant_iniciaciones');
                $table->integer('monto_iniciaciones');
                $table->integer('cant_regularizaciones');
                $table->integer('monto_regularizaciones');
                $table->integer('cant_afiliaciones_com');
                $table->integer('monto_afiliaciones_com');
                $table->integer('cant_afiliaciones_priv');
                $table->integer('monto_afiliaciones_priv');
                $table->integer('cant_dispensa_tramite');
                $table->integer('monto_dispensa_tramite');
                $table->integer('cant_derechos_exalt');
                $table->integer('monto_derechos_exalt');
                $table->integer('cant_credencial');
                $table->integer('monto_credencial');
                $table->integer('cant_diplomas');
                $table->integer('monto_diplomas');
                $table->integer('cant_liturgia_a');
                $table->integer('monto_liturgia_a');
                $table->integer('cant_liturgia_c');
                $table->integer('monto_liturgia_c');
                $table->integer('cant_liturgia_m');
                $table->integer('monto_liturgia_m');
                $table->integer('cant_status');
                $table->integer('monto_status');
                $table->integer('cant_constitucion');
                $table->integer('monto_constitucion');
                $table->integer('cant_codigos_penales');
                $table->integer('monto_codigos_penales');
                $table->integer('cant_activacion_logias');
                $table->integer('monto_activacion_logias');
                $table->integer('cant_aumento_sal');
                $table->integer('monto_aumento_sal');
                $table->integer('otros_conceptos');
                $table->integer('cuota_extra');
                $table->integer('pago'); //pago realizado
                $table->integer('total');// Suma de todos los montos
                $table->integer('adeudo');// = total - pago 
                $table->date('fecha');
                $table->integer('pagado');// 1 pagado - 0 no pagado

            });
        
/*
            Schema::table('recibo', function($table) {
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
        //
        Schema::drop('recibo');
    }
}
