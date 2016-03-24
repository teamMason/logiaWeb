<?php

namespace portalLogia\Http\Controllers;

use portalLogia\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use portalLogia\Http\Requests\RegistraMiembrosAdmRequest;
use portalLogia\Http\Requests\ActualizaMiembrosAdmRequest;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Taller;

use portalLogia\User;

class facturaVenerableController extends Controller
{
  public function buscaNombre(){
    $id = \Auth::user()->id_taller;
    $nombreTaller = Taller::select('nombreTaller')->where('id', '=', $id)->first();
    return $nombreTaller;
  }
  public function creaLiga($nombre){
    $nombre = str_replace(' ', '_', $nombre);

    return $nombre;
  }
  public function envia(){
    $nt=$this->buscaNombre();
    $nombre = $this->creaLiga($nt->nombreTaller);
    
;    return view('venerable.facturaVenerable',['nombre' => $nombre]);
  }
}
