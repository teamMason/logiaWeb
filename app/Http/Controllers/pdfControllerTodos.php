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
    /**
     * Generar todos los PDF.
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
     public function invoiceAll() 
    {           
        $talleres = Taller::all('id');
        $tTalleres = Taller::all()->count();
        $file_to_save = public_path().'/pdf/';
        $rubros = Rubros::all()->first();
        
        $ult_id = Recibos::select('id')->max('id');//obtener el ultimo id
        $prim_reg = $ult_id - $tTalleres + 1;
        
        foreach($talleres as $id){
            //Log::info($id->id);
            
            $datos = $this->mostrarPDF($id->id); //obteniendo las cantidades de cada taller
            $montos = $this->getMontos($datos);//Calculando los costos de cada taller
            $this->insertaMontos($prim_reg, $montos);//insertando los costos de cada taller
            $fecha = date('Y-m-d');
            
            $view =  \View::make('pdf.invoicePDFindividual', compact('datos', 'fecha', 'montos', 'rubros'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $nombre = str_replace(' ', '_', $datos['nombre_taller']->nombreTaller);
           
            file_put_contents($file_to_save.$nombre.".pdf", $pdf->output());
            $prim_reg = $prim_reg + 1;
        } 
        
        $this->insertarNuevosCampos();//insertar campos en cero para el nuevo mes
        $this->mostrarFacturas();
    }
    
    public function insertaMontos($id, $montos){//inserta las cantidades de los cobros
        $recibo = Recibos::find($id);
        //Log::info("id dentro de inserta montos");
        //Log::info($id);
        $m_totales = Miembros::where('id_taller','=', $id)->count(); //contar todos los miembros del taller
        $libres = Miembros::where('tipo_miembro', 'si')->where('id_taller','=', $id)->count();//encontrar los miembros libres
        $recibo->cant_capitas = $m_totales;
        $recibo->capitas_pagar = $m_totales - $libres;
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
        $recibo->adeudo = $montos['adeudo'] + $montos['total'];
        $recibo->total = $montos['total'];

        $recibo->save();
    }
    public function insertarNuevosCampos(){
        $tTalleres = Taller::all()->count();
        $tRecibos = Recibos::all()->count();
        $tRecibos = $tRecibos - $tTalleres + 1;
        $fecha = date('Y-m-d');
        $fecha_ult = Recibos::all()->last()->pluck('fecha'); //obtener la ultima fecha
        
        for($i = 0; $i < $tTalleres; $i++){
            //LOG::info($idTaller);
            //busca el recibo del taller en la ultima fecha de la tabla recibos
            $adeudo_ant = Recibos::select('adeudo')->where('id_taller','=', $i+1)->where('fecha', '=' , $fecha_ult)->first();  
            $recibo = new Recibos;
            $recibo->fecha = $fecha;
            $recibo->id_taller = $i + 1;
            //El nuevo recibo debe tener el adeudo anterior
            //$recibo->adeudo = $adeudo_ant;
            $recibo->save();
            //$idTaller += 1;
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

  

    public function mostrarPDF($id)
        {   
            $datos = [];
            $m = new Miembros;
            $recibo = new Recibos;
            $fecha = Recibos::all()->last()->pluck('fecha'); //obtener la ultima fecha            

            $nombre_taller = Taller::select('nombreTaller')->where('id', '=', $id)->first();
            $iniciaciones = Recibos::select('cant_iniciaciones')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();

            $reg = Recibos::select('cant_regularizaciones')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $afil_com = Recibos::select('cant_afiliaciones_com')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $afil_priv = Recibos::select('cant_afiliaciones_priv')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $disp_tram = Recibos::select('cant_dispensa_tramite')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $derechos_exalt = Recibos::select('cant_derechos_exalt')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $credencial = Recibos::select('cant_credencial')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $diplomas = Recibos::select('cant_diplomas')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $liturgia_a = Recibos::select('cant_liturgia_a')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $liturgia_c = Recibos::select('cant_liturgia_c')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $liturgia_m = Recibos::select('cant_liturgia_m')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $estatutos = Recibos::select('cant_status')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $constitucion = Recibos::select('cant_constitucion')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $codigos_penales = Recibos::select('cant_codigos_penales')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $aumento_sal = Recibos::select('cant_aumento_sal')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $act_logias = Recibos::select('cant_activacion_logias')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $otros = Recibos::select('otros_conceptos')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $extra = Recibos::select('cuota_extra')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            $adeudo = Recibos::select('adeudo')->where('id_taller','=', $id)->where('fecha', '=' , $fecha)->first();
            //Log::info($reg);           
            $m_totales = Miembros::where('id_taller','=', $id)->count();
            //$m_totales = Miembros::select()->where('id_taller','=', $m->id)->count();
            $libres = Miembros::where('tipo_miembro', 'si')->where('id_taller','=', $id)->count();//encontrar los miembros libres
            //$libres = Miembros::select("tipo_miembro = 'si' WHERE id_taller = 1")->count();

           
            $capitas_pagar = $m_totales - $libres;
            
            $datos['nombre_taller'] = $nombre_taller;
            $datos['cantidad'] = $m_totales;
            $datos['capitas_pagar'] = $capitas_pagar;
            $datos['regular'] = $reg;
            $datos['iniciaciones'] = $iniciaciones;
            $datos['afil_com'] = $afil_com;
            $datos['afil_priv'] = $afil_priv;
            $datos['disp_tram'] = $disp_tram;
            $datos['derechos_exalt'] = $derechos_exalt;
            $datos['credencial'] = $credencial;
            $datos['diplomas'] = $diplomas;
            $datos['liturgia_a'] = $liturgia_a;
            $datos['liturgia_c'] = $liturgia_c;
            $datos['liturgia_m'] = $liturgia_m;
            $datos['estatutos'] = $estatutos;
            $datos['constitucion'] = $constitucion;
            $datos['codigos'] = $codigos_penales;
            $datos['act_logias'] = $act_logias;
            $datos['aumento_sal'] = $aumento_sal;
            $datos['otros'] = $otros;
            $datos['extra'] = $extra;
            $datos['adeudo'] = $adeudo;

            return $datos;
        }
        public function getMontos($datos)
        { 
            $rubros = [];
            $rubros = Rubros::all()->first();
            //$datos = $this->MostrarPDF($id);

            $montos['capitas'] = $datos['capitas_pagar'] * $rubros->capitas;
            $montos['iniciaciones'] = $datos['iniciaciones']->cant_iniciaciones * $rubros->iniciaciones;
            $montos['regularizaciones'] = $datos['regular']->cant_regularizaciones * $rubros->regularizaciones;
            $montos['afiliaciones_com'] = $datos['afil_com']->cant_afiliaciones_com * $rubros->afiliaciones_com;
            $montos['afiliaciones_priv'] = $datos['afil_priv']->cant_afiliaciones_priv * $rubros->afiliaciones_priv;
            $montos['dispensa_tramite'] = $datos['disp_tram']->cant_dispensa_tramite * $rubros->dispensa_tramite;
            $montos['derechos_exalt'] = $datos['derechos_exalt']->cant_derechos_exalt * $rubros->derechos_exalt;
            $montos['credencial'] = $datos['credencial']->cant_credencial * $rubros->credencial;
            $montos['diplomas'] = $datos['diplomas']->cant_diplomas * $rubros->diplomas;
            $montos['liturgia_a'] = $datos['liturgia_a']->cant_liturgia_a * $rubros->liturgia_a;
            $montos['liturgia_c'] = $datos['liturgia_c']->cant_liturgia_c * $rubros->liturgia_c;
            $montos['liturgia_m'] = $datos['liturgia_m']->cant_liturgia_m * $rubros->liturgia_m;
            $montos['status'] = $datos['estatutos']->cant_status * $rubros->status;
            $montos['constitucion'] = $datos['constitucion']->cant_constitucion * $rubros->constitucion;
            $montos['codigos_penales'] = $datos['codigos']->cant_codigos_penales * $rubros->codigos_penales;
            $montos['act_logias'] = $datos['act_logias']->cant_activacion_logias * $rubros->derechos_logia;//Nota aqui hay anomalia  
            $montos['act_logias'] = $datos['act_logias']->cant_activacion_logias * $rubros->activacion_logias;
            $montos['aumento_sal'] = $datos['aumento_sal']->cant_aumento_sal * $rubros->aumento_sal;
            $montos['otros'] = $datos['otros']->otros_conceptos;
            $montos['cuota_ext'] = $datos['cantidad'] * $rubros->cuota_ext;

            $montos['adeudo'] = $datos['adeudo']->adeudo;

            $total = $montos['total'] = 0;
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
