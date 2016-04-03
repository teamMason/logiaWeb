<?php

namespace portalLogia\Http\Controllers;

use Illuminate\Http\Request;
use portalLogia\Http\Requests;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Taller;
use portalLogia\Miembros;
use portalLogia\Rubros;
use portalLogia\Recibos;
use Log; 

class listaIntroducePagoController extends Controller
{    
    public function enviaListaTalleres()//retorna los talleres
    {   //crear la consulta para mostrar los talleres
        $talleres = Taller::all();
        return view('administrador.seleccionaTallerPagos',['talleres' => $talleres]);
    }

    public function mostrarRecibo(){//mostrar el adeudo en unaa vista
        $m = new Miembros;
        $m->id = \Input::get('talleres');//obtener id seleccionado en la lista del select adeudo
        $name = Taller::select('nombreTaller')->where('id', '=', $m->id)->first();
        $fechas = $this->retornaFechas($m->id);
        $adeudos = $this->retornaAdeudos($m->id);
        //$a = array('adeudos' => $adeudos);
        //Log::info($adeudos);

        return view('administrador.introducePago')->with('name',$name)
            ->with('id', $m->id)->with('fechas', $fechas)->with('adeudos', $adeudos);
    }

    public function recibePago($id){//recibimos id del taller
        $fecha = \Input::get('fecha');//tomamos del select #fecha, el valor de la seleccion
        $pago = \Input::get('pago');//tomamos del select #adeudo, el valor de la seleccion
        
        //Log::info('fecha');
        //Log::info($fecha);
    
        //$recibo = Recibos::where("id_taller", "=", $id)->where("fecha", "=", $fecha)->first();
        $recibo = \DB::table('recibos')->
                    where(function($query) use ($fecha){
                        $query-> where('fecha','=', $fecha);
                    })->
                    where(function ($query) use ($id){
                        $query-> where('id_taller', '=' , $id);
                    })->first();
        
        $rec = Recibos::find($recibo->id);
        //dd($recibo->total - $pago);
        $rec['adeudo'] = $recibo->total - $pago;//calculamos el adeudo con el pago y el total
        if($rec["adeudo"] <= 0){
            $rec["pagado"] = 1;//1 es pagado
        }
        Log::info('se salva');
        $rec->save();
        //$this->enviaListaTalleres();        
    }
    public function retornaFechas($id){  //tomamos las fechas un taller que esten pagadas     
        //1 = pagado - 0 = no pagado
        $fechas = Recibos::select('fecha')->where('id_taller', $id)->where('pagado', "=", 0)->get();
        return $fechas;   
    }
    public function retornaAdeudos($id){//tomamos lo que debe del taller elejido
            $adeudos = Recibos::select('adeudo')->where('id_taller', $id)->where('pagado', "=", 0)->get();
            return $adeudos;   
        }
        
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
