<?php

namespace portalLogia\Http\Controllers;

use portalLogia\Http\Controllers\Controller;
use portalLogia\Miembros;
use portalLogia\Taller;
use Log;

class DashboardController extends Controller
{
	public function index(){
		$tumultoEns = [];//contendran los id de los talleres referente al oriente que pertenecen
		$tumultoMex = [];
		$tumultoTij = [];
		$tumultoRos = [];

		$talleresEns = Taller::select('id')->where('ciudad', '=', 'Ensenada')->get(); //Ensenada
		$talleresQuin = Taller::select('id')->where('ciudad', '=', 'San Quintin')->get();
		$talleresCam = Taller::select('id')->where('ciudad', '=', 'Camalu')->get();
		$talleresFel = Taller::select('id')->where('ciudad', '=', 'San Felipe')->get();
		$talleresGpe = Taller::select('id')->where('ciudad', '=', 'Valle Guadalupe')->get();

		$talleresVgo = Taller::select('id')->where('ciudad', '=', 'Vicente Guerrero')->get();//Mexicali
		$talleresMex = Taller::select('id')->where('ciudad', '=', 'Mexicali')->get();

		$talleresRos = Taller::select('id')->where('ciudad', '=', 'Rosarito')->get();// Tijuana
		$talleresTij = Taller::select('id')->where('ciudad', '=', 'Tijuana')->get();
		
		foreach($talleresEns as $taller){
			//log::info($taller->id);
			array_push($tumultoEns, $taller->id);
		}
		foreach($talleresGpe as $taller){
			//log::info($taller->id);
			array_push($tumultoEns, $taller->id);
		}
		foreach($talleresQuin as $taller){
			array_push($tumultoEns, $taller->id);
		}
		foreach($talleresRos as $taller){
			array_push($tumultoRos, $taller->id);
		}
		foreach($talleresCam as $taller){
			array_push($tumultoEns, $taller->id);
		}
		foreach($talleresFel as $taller){
			array_push($tumultoMex, $taller->id);
		}
		foreach($talleresMex as $taller){
			array_push($tumultoMex, $taller->id);
		}
		foreach($talleresVgo as $taller){
			array_push($tumultoMex, $taller->id);
		}
		foreach($talleresTij as $taller){
			array_push($tumultoTij, $taller->id);
		}

		$mTotalEns = $this->sumaMiembros($tumultoEns);
		$mTotalMex = $this->sumaMiembros($tumultoMex);
		$mTotalTij = $this->sumaMiembros($tumultoTij);
		$mTotalRos = $this->sumaMiembros($tumultoRos);

		//$miembrosOriente["chart"] = array("type" => "bar");//las graficas seran barras
	    $miembrosOriente["title"] = array("text" => "Miembros Totales por Oriente");//titulo de la grafica
	    $miembrosOriente["xAxis"] = array("categories" => ['Ensenada', 'Mexicali', 'Tijuana', 'Rosarito']);
	    $miembrosOriente["yAxis"] = array("title" => array("text" => "Cantidad de Miembros"));

	    $miembrosOriente["series"] = [
	        array("name" => "Total de Miembros", "data" => [$mTotalEns, $mTotalMex, $mTotalTij, $mTotalRos])
	    ];
	    $mOrienteGrado = $this->MiembrosMRGLEBCoriente($tumultoEns, $tumultoMex, $tumultoTij, $tumultoRos);
	    $mGrado = 		 $this->miembrosMRGLE($tumultoEns, $tumultoMex, $tumultoTij, $tumultoRos);
	    $pasTrans = 		 $this->miembrosPastTrans($tumultoEns, $tumultoMex, $tumultoTij, $tumultoRos);

	    return view('administrador.dashboard', compact('miembrosOriente','mOrienteGrado','mGrado','pasTrans') );
	}

	public function MiembrosMRGLEBCoriente($tEns, $tMex, $tTij, $tRos){
		$orEns = $this->sumaMiembrosGrado($tEns);// Obtenemos las cantidades por oriente
		$orMex = $this->sumaMiembrosGrado($tMex);
		$orTij = $this->sumaMiembrosGrado($tTij);
		$orRos = $this->sumaMiembrosGrado($tRos);
		$pastMaster=0; $companeros=0;
		$maestros=0; $aprendices=0;
		$miembrosOriente["chart"] = array("type" => "column");//las graficas seran barras
	    $miembrosOriente["title"] = array("text" => "Miembros por Oriente y Grado");//titulo de la grafica
	    $miembrosOriente["xAxis"] = array("categories" => ['Ensenada', 'Mexicali', 'Tijuana','Rosarito']); //titulos en el eje x
	    $miembrosOriente["yAxis"] = array("title" => array("text" => "Cantidad de Miembros"));

	    $miembrosOriente["series"] = [
	        array("name" => "Past-Master", "data" => [$orEns[0],$orMex[0],$orTij[0],$orRos[0] ]),
	        array("name" => "Maestros", "data" => [$orEns[1],$orMex[1],$orTij[1],$orRos[1] ]),
	        array("name" => "Companeros", "data" => [$orEns[2],$orMex[2],$orTij[2],$orRos[2] ]),
	        array("name" => "Aprendices", "data" => [$orEns[3],$orMex[3],$orTij[3],$orRos[3] ])
	    ];
	    

		return $miembrosOriente;
	}
	public function miembrosPastTrans($tEns, $tMex, $tTij){
		$orEns = $this->sumaMiembrosGrado($tEns);// Obtenemos las cantidades por oriente
		$orMex = $this->sumaMiembrosGrado($tMex);
		$orTij = $this->sumaMiembrosGrado($tTij);
		$pastMaster=0; $transitorios=0;
		$pasTrans["chart"] = array("type" => "bar");//las graficas seran barras
	    $pasTrans["title"] = array("text" => "Miembros Gran Logia Muy Respetable Gran Logia De Estado Baja California");//titulo de la grafica
	    $pasTrans["xAxis"] = array("categories" => ['Past-Master', 'Transitorias']); //titulos en el eje x
	    $pasTrans["yAxis"] = array("title" => array("text" => "Cantidad de Miembros"));
	    $pastMaster = $orEns[0] + $orMex[0] + $orTij[0];
	    $maestros = $orEns[1] + $orMex[1] + $orTij[1];
	    $companeros = $orEns[2] + $orMex[2] + $orTij[2];
	    $transitorios = $maestros;//$transitorios = $maestros + $companeros;
	    $pasTrans["series"] = [
	        array("name" => "Past-Master", "data" => [$pastMaster]),
	        array("name" => "Transitorios", "data" => [$transitorios])
		];

		return $pasTrans;
	}
	public function miembrosMRGLE($tEns, $tMex, $tTij){
		$orEns = $this->sumaMiembrosGrado($tEns);// Obtenemos las cantidades por oriente
		$orMex = $this->sumaMiembrosGrado($tMex);
		$orTij = $this->sumaMiembrosGrado($tTij);
		$pastMaster=0; $companeros=0;
		$maestros=0; $aprendices=0;

		$miembrosGrado["chart"] = array("type" => "bar");//las graficas seran barras
	    $miembrosGrado["title"] = array("text" => "Total de Miembros de MRGLEBC por Grado");//titulo de la grafica
	    $miembrosGrado["xAxis"] = array("categories" => ['Past-Master', 'Maestros', 'Companeros', 'Aprendices']); //titulos en el eje x
	    $miembrosGrado["yAxis"] = array("title" => array("text" => "Cantidad de Miembros"));

	    $pastMaster = $orEns[0] + $orMex[0] + $orTij[0];
	    $maestros = $orEns[1] + $orMex[1] + $orTij[1];
	    $companeros = $orEns[2] + $orMex[2] + $orTij[2];
	    $aprendices = $orEns[3] + $orMex[3] + $orTij[3];

	    $miembrosGrado["series"] = [
	        array("name" => "Ocultar barras", "data" => [$pastMaster,$maestros,$companeros,$aprendices ])
		];

		return $miembrosGrado;
	}

	public function sumaMiembrosGrado($tumultoTalleres){
		$mTotales = 0;
		$cTotales = 0;
		$pTotales = 0;
		$aTotales = 0;
		$oriente=[4];
		
		for($i = 0; $i<count($tumultoTalleres); $i++){
			$id = $tumultoTalleres[$i];
			$mTotales = $mTotales + Miembros::where('id_taller', '=', $id)->where("grado", "=", "MAESTRO")->count();
			$pTotales = $pTotales + Miembros::where('id_taller', '=', $id)->where("grado", "=", "PAST MASTER")->count();
			$cTotales = $cTotales + Miembros::where('id_taller', '=', $id)->where("grado", "=", "COMPANERO")->count();
			$aTotales = $aTotales + Miembros::where('id_taller', '=', $id)->where("grado", "=", "APRENDIZ")->count();
		}
		$oriente[0] = $pTotales;
		$oriente[1] = $mTotales;
		$oriente[2] = $cTotales;
		$oriente[3] = $aTotales;

		return $oriente;
		
	}

	public function sumaMiembros($tumultoTalleres){
		$mTotales = 0;
		for($i = 0; $i<count($tumultoTalleres); $i++){
			$id = $tumultoTalleres[$i];
			$mTotales = $mTotales + Miembros::where('id_taller', '=', $id)->count();
		}

		return $mTotales;
	}
}
