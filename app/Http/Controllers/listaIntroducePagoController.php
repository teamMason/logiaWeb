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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
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

    public function recibePago($id){//id del taller
        Log::info("entro");
        $fecha = \Input::get('fecha');//tomamos del select #fecha, el valor de la seleccion
        $pago = \Input::get('adeudo');//tomamos del select #adeudo, el valor de la seleccion
        $l = \Input::all();
        Log::info('l');
        Log::info($l);
        Log::info('fecha');
        Log::info($fecha);
        Log::info('pago');
        Log::info($pago);
        //Log::info("este es el pago");
        //Log::info($pago);
        //$fecha = Recibos::all()->last(); //obtener la ultima fecha 
        //$fecha = $fecha->fecha;
        //$select = Recibos::select('adeudo', 'id')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();  
        //$adeudo_ant = $select->adeudo;
        //dd($select->adeudo);
        //$id_select = $select->id;
        //$total = $adeudo_ant - $pago;
        
        // Seleccionamos el adeudo del taller en la fecha exacta
        //$r = Recibos::where('id_taller',$id)->where('fecha',$fecha)->get();
        //Log::info($r);
        //$r=$r[0];
        //$rec = Recibos::find($id);//->where('id_taller',$id)->where('fecha',$fecha)->where('fecha',$fecha)->get(); 
        $count = Recibos::where('id_taller', '=', $id, 'and', 'fecha', '=' ,$fecha)->get();
        Log::info($count);
        //$r->adeudo = $total - $pago;
        //$r->pago = $pago;
        //$r->save();
        //return $pago;
        
    }
    /*public function retornaRecibos($id){      
            $fecha = Recibos::all()->last()->pluck('fecha'); //obtener la ultima fecha 
            $recibos = Recibos::select('adeudo')->where('id_taller', '=', $id)->where('fecha','=', $fecha)->first();
            return $recibos;   
        }*/
     public function retornaFechas($id){      
        //1 = pagado - 0 = no pagado
            $fechas = Recibos::select('fecha')->where('id_taller', $id)->where('pagado', 0)->get();
            return $fechas;   
        }
    public function retornaAdeudos($id){
            $adeudos = Recibos::select('adeudo')->where('id_taller', $id)->where('pagado', 0)->get();
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
