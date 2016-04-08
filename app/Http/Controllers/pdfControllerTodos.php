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

class pdfControllerTodos extends Controller
{
    
     public function invoiceAll() 
    {           
        $talleres = Taller::all('id');
        $tTalleres = Taller::all()->count();
        $file_to_save = public_path().'/pdf/';
        $rubros = Rubros::all()->first();
        
        $ult_id = Recibos::select('id')->max('id');//obtener el ultimo id
        $prim_reg = $ult_id - $tTalleres +1;
        foreach($talleres as $id){
            $extras = $this->camposExtras($id->id); 
            $datos = $this->mostrarPDF($id->id); //obteniendo las cantidades de cada taller
            //dd($datos[0]->id);
            $montos = $this->getMontos($datos, $extras);//Calculando los costos de cada taller
            $this->insertaMontos($prim_reg, $montos);//insertando los costos de cada taller
            $fecha = date('Y-m-d');
            $view =  \View::make('pdf.invoicePDF', compact('datos', 'fecha', 'montos', 'rubros', 'extras'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $nombre = str_replace(' ', '_', $extras['nombre_taller']);
           
            file_put_contents($file_to_save.$nombre.".pdf", $pdf->output());
            $prim_reg = $prim_reg + 1;
        } 
        
        $this->insertarNuevosCampos();//insertar campos en cero para el nuevo mes
        $this->mostrarFacturas();

        return \Redirect::route('listaFacturas')
      ->with('alert', 'Las facturas se han realizado exitosamente');   
    }
    public function camposExtras($id){
        $extras=[];
        $nombre_taller = Taller::select('nombreTaller')->where('id', '=', $id)->first();
        $datos['nombre_taller'] = $nombre_taller['nombreTaller'];
            $m_totales = Miembros::where('id_taller','=', $id)->count();
            //$libres = Miembros::where('mlibre', 'si')->where('id_taller','=', $id)->count();//encontrar los miembros libres
            $libres = \DB::table('miembros')->
                    where(function($query){
                        $query-> where('mlibre','=', 'si');
                    })->
                    where(function ($query) use ($id){
                        $query-> where('id_taller', '=' , $id);
                    })->count();
            
            $capitas_pagar = $m_totales - $libres;
            $datos['capitas_pagar'] = $capitas_pagar;
            $datos['m_totales'] = $m_totales;

            return $datos;
    }
    public function insertaMontos($id, $montos){//inserta las cantidades de los cobros
        $extras = $this->camposExtras($id);
        $recibo = Recibos::find($id);
        
        $m_totales = Miembros::where('id_taller','=', $id)->count(); //contar todos los miembros del taller
        //$libres = Miembros::where('mlibre', '=' 'SI')->where('id_taller','=', $id)->count();//encontrar los miembros libres
        //Log::info($extras);
        $recibo->cant_capitas = $extras['m_totales'];
        $recibo->capitas_pagar = $extras['capitas_pagar'];
        $recibo->monto_capitas = $montos['capitas'];
        $recibo->monto_iniciaciones = $montos['iniciaciones'];
        $recibo->monto_regularizaciones = $montos['regularizaciones'];
        $recibo->monto_afiliaciones_com = $montos['afiliaciones_com'];
        $recibo->monto_afiliaciones_priv = $montos['afiliaciones_priv'];
        $recibo->monto_dispensa_tramite = $montos['dispensa_tramite'];
        $recibo->monto_derechos_exalt = $montos['derechos_exalt'];
        $recibo->monto_credencial = $montos['credencial'];
        $recibo->monto_diplomas = $montos['diplomas'];
        $recibo->monto_liturgia_a = $montos['liturgia_a'];
        $recibo->monto_liturgia_c = $montos['liturgia_c'];
        $recibo->monto_liturgia_m = $montos['liturgia_m'];
        $recibo->monto_status = $montos['status'];
        $recibo->monto_constitucion = $montos['constitucion'];
        $recibo->monto_codigos_penales = $montos['codigos_penales'];
        $recibo->monto_activacion_logias = $montos['act_logias'];
        $recibo->monto_aumento_sal = $montos['aumento_sal'];
        $recibo->otros_conceptos = $montos['otros'];
        $recibo->cuota_extra = $montos['cuota_ext'];
        $recibo->adeudo = $montos['total'];
        $recibo->total = $montos['total'];

        $recibo->save();
    }
    public function insertarNuevosCampos(){
        $tTalleres = Taller::all()->count();
        $tRecibos = Recibos::all()->count();
        $tRecibos = $tRecibos - $tTalleres + 1;
        $fecha = date('Y-m-d');

        $endRegister = Recibos::all()->last();
        $fecha_ult = $endRegister->fecha;
        //$fecha_ult = Recibos::all()->last()->pluck('fecha'); //obtener la ultima fecha
        
        for($i = 0; $i < $tTalleres; $i++){
            //busca el recibo del taller en la ultima fecha de la tabla recibos
            //$adeudo_ant = Recibos::select('adeudo')->where('id_taller','=', $i+1)->where('fecha', '=' , $fecha_ult)->first();  
            $recibo = new Recibos;
            $recibo->fecha = $fecha;
            $recibo->id_taller = $i + 1;
            $recibo->save();
        }  
          
    }

    public function mostrarFacturas(){
        $nom=[];
        $i=0;
        $nombres = Taller::all('nombreTaller');
        foreach ($nombres as $nombre){
            $nombre = str_replace(' ', '_', $nombre->nombreTaller);
            $nom[$i] = $nombre;
            $i = $i+1;
        }

        return view('administrador.mostrarpdf')->with('nom', $nom);
    }
    
    public function create()//retorna los talleres
    {
        //crear la consulta para mostrar los talleres
        $talleres = Taller::all();
        return view('PDF.seleccionaTaller',['talleres' => $talleres]);
    }

    public function mostrarPDF($id) //regresa las cantidades de las operaciones de cada taller
        {   
            $datos = [];
            $m = new Miembros;
            $endRegister = Recibos::all()->last();
            $fecha = $endRegister->fecha;
            //$fecha = Recibos::all()->last()->pluck('fecha'); //obtener la ultima fecha            
            
            $datos = \DB::table('recibos')->
                    where(function($query) use ($id){
                        $query-> where('id_taller','=', $id);
                    })->
                    where(function ($query) use ($fecha){
                        $query-> where('fecha', '=' , $fecha);
                    })->get();
            //dd($datos);
            return $datos;
        }

        public function getMontos($datos,$extras)
        { 
            $montos = [];
            $rubros = [];
            $rubros = Rubros::all()->first();
            //$datos = $this->MostrarPDF($id);
            //dd($rubros->iniciaciones);
           //dd($datos[0]->adeudo);
            //Log::info($datos);
            $montos['capitas'] = $extras['capitas_pagar'] * $rubros->capitas;
            $montos['iniciaciones'] = $datos[0]->cant_iniciaciones * $rubros->iniciaciones;
            $montos['regularizaciones'] = $datos[0]->cant_regularizaciones * $rubros->regularizaciones;
            $montos['afiliaciones_com'] = $datos[0]->cant_afiliaciones_com * $rubros->afiliaciones_com;
            $montos['afiliaciones_priv'] = $datos[0]->cant_afiliaciones_priv * $rubros->afiliaciones_priv;
            $montos['dispensa_tramite'] = $datos[0]->cant_dispensa_tramite * $rubros->dispensa_tramite;
            $montos['derechos_exalt'] = $datos[0]->cant_derechos_exalt * $rubros->derechos_exalt;
            $montos['credencial'] = $datos[0]->cant_credencial * $rubros->credencial;
            $montos['diplomas'] = $datos[0]->cant_diplomas * $rubros->diplomas;
            $montos['liturgia_a'] = $datos[0]->cant_liturgia_a * $rubros->liturgia_a;
            $montos['liturgia_c'] = $datos[0]->cant_liturgia_c * $rubros->liturgia_c;
            $montos['liturgia_m'] = $datos[0]->cant_liturgia_m * $rubros->liturgia_m;
            $montos['status'] = $datos[0]->cant_status * $rubros->status;
            $montos['constitucion'] = $datos[0]->cant_constitucion * $rubros->constitucion;
            $montos['codigos_penales'] = $datos[0]->cant_codigos_penales * $rubros->codigos_penales;
            //$montos['act_logias'] = $datos[0]->cant_activacion_logias * $rubros->derechos_logia;
            $montos['act_logias'] = $datos[0]->cant_activacion_logias * $rubros->activacion_logias;
            $montos['aumento_sal'] = $datos[0]->cant_aumento_sal * $rubros->aumento_sal;
            $montos['otros'] = $datos[0]->otros_conceptos;
            $montos['cuota_ext'] = $datos[0]->cuota_extra * $rubros->cuota_ext;
            //$montos['adeudo'] = $datos[0]->adeudo;

            if ($datos[0]->pagado == 1){ //revisar si el campo pagado tiene un 1 entonces ya fue pagada esa factura
                $montos['adeudo'] = 0;
            }
            $total = 0;
            $montos['total'] = 0;
            //dd($montos);
            foreach ($montos as $monto=>$i ){
                $total = $total + $i;
            }
            $montos['total'] = $total;
            
            return $montos;
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
