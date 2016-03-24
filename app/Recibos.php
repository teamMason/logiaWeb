<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Recibos extends Model
{

    protected $table = 'recibos';

    public $timestamps = false;

    protected $fillable = [ 'id_taller', 'fecha' ];


    public function taller()
    {
        return $this->belongsTo(Talleres::class);
    }


    static function hacerCobroAunmentoComp($id_taller)
    {
        $endRegister = Recibos::all()->last();
        $fecha = $endRegister->fecha;

        $endPago = \DB::table('recibos')
            ->where(function ($query) use ($id_taller)
            {
                $query->where('id_taller', $id_taller);
            })->
            where(function ($query) use ( $fecha)
            {
                $query->where('fecha',$fecha);

            })->first();

       /*guardar*/

        $taller = Recibos::find($endPago->id);
        $taller->cant_aumento_sal = $taller->cant_aumento_sal + 1;
        $taller->save();

    }
    static public function buscarUltimoMes($id_taller)
    {
        $endRegister = Recibos::all()->last();
        $fecha = $endRegister->fecha;

        $endPago = \DB::table('recibos')
            ->where(function ($query) use ($id_taller)
            {
                $query->where('id_taller', $id_taller);
            })->
            where(function ($query) use ( $fecha)
            {
                $query->where('fecha',$fecha);

            })->first();

        return $endPago;


    }

    static function hacerCobroAunmentoMM($id_taller)
    {


        $ultimaFactura = Recibos::buscarUltimoMes($id_taller);

        $taller = Recibos::find($ultimaFactura->id);
        $taller->cant_derechos_exalt = $taller->cant_derechos_exalt + 1;
        $taller->save();

    }

    static public function altaMiembroPago($id_taller)
    {
        $ultimaFactura = Recibos::buscarUltimoMes($id_taller);
        $taller = Recibos::find($ultimaFactura->id);
        $taller->cant_regularizaciones = $taller->cant_regularizaciones + 1;
        $taller->save();

    }

    static function hacerCobroIniciacion($id_taller)
    {
        $ultimaFactura = Recibos::buscarUltimoMes($id_taller);

        $taller = Recibos::find($ultimaFactura->id);
        $taller->cant_iniciaciones = $taller->cant_iniciaciones + 1;
        $taller->save();


    }
}
