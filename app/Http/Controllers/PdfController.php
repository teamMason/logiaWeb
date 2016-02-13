<?php

namespace portalLogia\Http\Controllers;

use Illuminate\Http\Request;
use portalLogia\Http\Requests;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Miembros;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
    *   funcion para invocar
    *   la creacion del archivo pdf
    **/
     public function invoice() 
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice'); //Mostrar en pantalla
        //return $pdf->download('invoice'); //Descargar el archivo
    }

    public function getData() 
    {
        $cantidades=[];
        $idTalleres = Miembros::select('id_taller')->distinct()->get();
       
        foreach ($idTalleres as $idTaller){ 
            $id = $idTaller->id_taller;
            $cantidad = Miembros::where('id_taller','=', $id)->count();
            //Log::info($cantidad);
            $cantidades[]=$cantidad;

        }
        
        $data =  [
            'quantity'      => $idTalleres[0]->id_taller ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
        
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
