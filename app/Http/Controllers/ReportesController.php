<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Miembro;


class ReportesController extends Controller
{
	public function getIndex(){
		$reportes = Miembro::all();
	 	return view('Reportes.index', ['reportes' => $reportes]);
	}
}
