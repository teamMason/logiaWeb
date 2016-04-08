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

class pdfListaController extends Controller
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
     public function invoiceIndividual() { 
        $datos = $this->mostrarPDF();
        //dd($datos);
        $extras = $this->camposExtras($datos['id']);
        $montos = $this->getMontos();
        $rubros = Rubros::all()->first();
        $fecha = date('Y-m-d');
        //dd($rubros['diplomas']);
        //dd($rubros);
        $view =  \View::make('PDF.invoicePDFindividual', compact('datos', 'fecha', 'montos', 'rubros', 'extras'))->render();
        //$view =  \View::make('pdf.invoicePDFindividual', ['datos' => $datos, 'fecha'=>$fecha])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $nombre = 'factura_de_'.$datos['nombre_taller']; 

        return $pdf->stream($nombre.'_.pdf'); //Mostrar en pantalla
        
    }
   
    public function create(){//retorna los talleres
        //crear la consulta para mostrar los talleres
        $talleres = Taller::all();
        $fechas = Recibos::select('fecha')->distinct()->get();
        return view('PDF.seleccionaTaller',['talleres' => $talleres, 'fechas' => $fechas]);
    }
  

    public function mostrarPDF(){   
            $datos = [];
            $m = new Miembros;
            $recibo = new Recibos;
            //$fecha = Recibos::all()->last()->pluck('fecha'); //obtener la ultima fecha

            $m->id = \Input::get('talleres');//obtener id seleccionado en la lista
            $fecha = \Input::get('fechas');
            $id = $m->id;
            $reciboTaller = \DB::table('recibos')->
                where(function($query) use ($id){
                    $query->where('id_taller', '=', $id);
                })->
                where(function ($query) use ($fecha){
                    $query->where('fecha', '=', $fecha);
                })->first();                   

            //dd($reciboTaller);
            $nombre_taller = Taller::select('nombreTaller')->where('id', '=', $m->id)->get();
            $iniciaciones = Recibos::select('cant_iniciaciones')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();

            $m_totales = Miembros::where('id_taller','=', $m->id)->count();
            $libres = Miembros::where('mlibre', 'SI')->where('id_taller','=', $m->id)->count();//encontrar los miembros libres
           
            $capitas_pagar = $m_totales - $libres;
            
            $datos['id'] = $reciboTaller->id_taller;
            //dd($nombre_taller[0]->nombreTaller);
            $datos['nombre_taller'] = $nombre_taller[0]->nombreTaller;
            $datos['cantidad'] = $m_totales;
            $datos['capitas_pagar'] = $reciboTaller->capitas_pagar;
            $datos['regular'] = $reciboTaller->cant_regularizaciones;
            $datos['iniciaciones'] = $reciboTaller->cant_iniciaciones;
            $datos['afil_com'] = $reciboTaller->cant_afiliaciones_com;
            $datos['afil_priv'] = $reciboTaller->cant_afiliaciones_priv;
            $datos['disp_tram'] = $reciboTaller->cant_dispensa_tramite;
            $datos['derechos_exalt'] = $reciboTaller->cant_derechos_exalt;
            $datos['credencial'] = $reciboTaller->cant_credencial;
            $datos['diplomas'] = $reciboTaller->cant_diplomas;
            $datos['liturgia_a'] = $reciboTaller->cant_liturgia_a;
            $datos['liturgia_c'] = $reciboTaller->cant_liturgia_c;
            $datos['liturgia_m'] = $reciboTaller->cant_liturgia_m;
            $datos['estatutos'] = $reciboTaller->cant_status;
            $datos['constitucion'] = $reciboTaller->cant_constitucion;
            $datos['codigos'] = $reciboTaller->cant_codigos_penales;
            $datos['act_logias'] = $reciboTaller->cant_activacion_logias;
            $datos['aumento_sal'] = $reciboTaller->cant_aumento_sal;
            $datos['otros'] = $reciboTaller->otros_conceptos;
            $datos['extra'] = $reciboTaller->cuota_extra;
            $datos['adeudo'] = $reciboTaller->adeudo;

            return $datos;
        }
        public function camposExtras($id){
        $extras=[];
        $nombre_taller = Taller::select('nombreTaller')->where('id', '=', $id)->first();
        $datos['nombre_taller'] = $nombre_taller['nombreTaller'];
            $m_totales = Miembros::where('id_taller','=', $id)->count();
            //$libres = Miembros::where('mlibre', 'si')->where('id_taller','=', $id)->count();//encontrar los miembros libres
            $libres = \DB::table('miembros')->
                    where(function($query){
                        $query-> where('mlibre','=', 'SI');
                    })->
                    where(function ($query) use ($id){
                        $query-> where('id_taller', '=' , $id);
                    })->count();
            
            $capitas_pagar = $m_totales - $libres;
            $datos['capitas_pagar'] = $capitas_pagar;
            $datos['m_totales'] = $m_totales;

            return $datos;
    }
        public function getMontos()
        { 
            $rubros = [];
            $rubros = Rubros::all()->first();
            $datos = $this->MostrarPDF();
            //dd($datos['id']);
            $montos['capitas'] = $datos['capitas_pagar'] * $rubros->capitas;
            $montos['iniciaciones'] = $datos['iniciaciones'] * $rubros->iniciaciones;
            $montos['regularizaciones'] = $datos['regular'] * $rubros->regularizaciones;
            $montos['afiliaciones_com'] = $datos['afil_com'] * $rubros->afiliaciones_com;
            $montos['afiliaciones_priv'] = $datos['afil_priv'] * $rubros->afiliaciones_priv;
            $montos['dispensa_tramite'] = $datos['disp_tram'] * $rubros->dispensa_tramite;
            $montos['derechos_exalt'] = $datos['derechos_exalt'] * $rubros->derechos_exalt;
            $montos['credencial'] = $datos['credencial'] * $rubros->credencial;
            $montos['diplomas'] = $datos['diplomas'] * $rubros->diplomas;
            $montos['liturgia_a'] = $datos['liturgia_a'] * $rubros->liturgia_a;
            $montos['liturgia_c'] = $datos['liturgia_c'] * $rubros->liturgia_c;
            $montos['liturgia_m'] = $datos['liturgia_m'] * $rubros->liturgia_m;
            $montos['status'] = $datos['estatutos'] * $rubros->status;
            $montos['constitucion'] = $datos['constitucion'] * $rubros->constitucion;
            $montos['codigos_penales'] = $datos['codigos'] * $rubros->codigos_penales;
            $montos['act_logias'] = $datos['act_logias'] * $rubros->derechos_logia;  
            $montos['act_logias'] = $datos['act_logias'] * $rubros->activacion_logias;
            $montos['aumento_sal'] = $datos['aumento_sal'] * $rubros->aumento_sal;
            $montos['otros'] = $datos['otros'];
            
            $montos['cuota_ext'] = $datos['cantidad'] * $rubros->cuota_ext;
            
            //$montos['extra'] = $datos['extra']->cuota_extra;

            $montos['adeudo'] = $datos['adeudo'];

            $total = $montos['total'] = 0;
            foreach ($montos as $monto=>$i ){
                $total = $total + $i;
            }
            $montos['total'] = $total;
            
            return $montos;
        }
    
}
