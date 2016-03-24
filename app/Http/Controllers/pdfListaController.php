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
        $montos = $this->getMontos();
        $rubros = Rubros::all()->first();
        $fecha = date('Y-m-d');
        
        $view =  \View::make('pdf.invoicePDFindividual', compact('datos', 'fecha', 'montos', 'rubros'))->render();
        //$view =  \View::make('pdf.invoicePDFindividual', ['datos' => $datos, 'fecha'=>$fecha])->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $nombre = 'factura_de_'.$datos['nombre_taller']->nombreTaller; 

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
            Log::info($fecha);
            $nombre_taller = Taller::select('nombreTaller')->where('id', '=', $m->id)->first();
            $iniciaciones = Recibos::select('cant_iniciaciones')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();

            $reg = Recibos::select('cant_regularizaciones')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $afil_com = Recibos::select('cant_afiliaciones_com')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $afil_priv = Recibos::select('cant_afiliaciones_priv')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $disp_tram = Recibos::select('cant_dispensa_tramite')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $derechos_exalt = Recibos::select('cant_derechos_exalt')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $credencial = Recibos::select('cant_credencial')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $diplomas = Recibos::select('cant_diplomas')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $liturgia_a = Recibos::select('cant_liturgia_a')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $liturgia_c = Recibos::select('cant_liturgia_c')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $liturgia_m = Recibos::select('cant_liturgia_m')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $estatutos = Recibos::select('cant_status')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $constitucion = Recibos::select('cant_constitucion')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $codigos_penales = Recibos::select('cant_codigos_penales')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $aumento_sal = Recibos::select('cant_aumento_sal')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $act_logias = Recibos::select('cant_activacion_logias')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $otros = Recibos::select('otros_conceptos')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $extra = Recibos::select('cuota_extra')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();
            $adeudo = Recibos::select('adeudo')->where('id_taller','=', $m->id)->where('fecha', '=' , $fecha)->first();

            $m_totales = Miembros::where('id_taller','=', $m->id)->count();
            //$m_totales = Miembros::select()->where('id_taller','=', $m->id)->count();
            $libres = Miembros::where('tipo_miembro', 'si')->where('id_taller','=', $m->id)->count();//encontrar los miembros libres
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
        public function getMontos()
        { 
            $rubros = [];
            $rubros = Rubros::all()->first();
            $datos = $this->MostrarPDF();
            
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
            $montos['act_logias'] = $datos['act_logias']->cant_activacion_logias * $rubros->derechos_logia;  
            $montos['act_logias'] = $datos['act_logias']->cant_activacion_logias * $rubros->activacion_logias;
            $montos['aumento_sal'] = $datos['aumento_sal']->cant_aumento_sal * $rubros->aumento_sal;
            $montos['otros'] = $datos['otros']->otros_conceptos;
            
            $montos['cuota_ext'] = $datos['cantidad'] * $rubros->cuota_ext;
            
            //$montos['extra'] = $datos['extra']->cuota_extra;

            $montos['adeudo'] = $datos['adeudo']->adeudo;

            $total = $montos['total'] = 0;
            foreach ($montos as $monto=>$i ){
                $total = $total + $i;
            }
            $montos['total'] = $total;
            
            return $montos;
        }
    
}
