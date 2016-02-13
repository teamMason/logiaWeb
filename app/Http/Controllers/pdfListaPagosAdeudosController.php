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

class pdfListaPagosAdeudosController extends Controller
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
    
    public function enviaTalleres()//retorna los talleres
    {   //crear la consulta para mostrar los talleres
        $talleres = Taller::all();
        return view('administrador.seleccionaTallerPagos',['talleres' => $talleres]);
    }

    public function mostrarRecibos(){
        $m = new Miembros;
        $m->id = \Input::get('talleres');//obtener id seleccionado en la lista
        $recibos = $this->retornaRecibos($m->id);
        //Log::info(json_encode($recibos));
 
        return view('administrador.mostrarPagosAdeudos',['recibos' => $recibos]);
    }

    public function retornaRecibos($id){                 
            $recibos = Recibos::where('id_taller', '=', $id)->get();

            return $recibos;   
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
