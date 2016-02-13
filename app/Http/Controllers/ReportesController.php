<?php

namespace portalLogia\Http\Controllers;

use portalLogia\Http\Controllers\Controller;
use portalLogia\Miembro;


class ReportesController extends Controller
{
	public function getIndex(){
		$reportes = Miembros::all();
	 	return view('Reportes.index', ['reportes' => $reportes]);
	}
}
