<?php

namespace portalLogia\Http\Controllers;

use portalLogia\Http\Controllers\Controller;
use portalLogia\Miembro;


class DashboardController extends Controller
{
	public function index(){
		$yourFirstChart["chart"] = array("type" => "bar");
	    $yourFirstChart["title"] = array("text" => "Fruit Consumption");
	    $yourFirstChart["xAxis"] = array("categories" => ['Apples', 'Bananas', 'Oranges']);
	    $yourFirstChart["yAxis"] = array("title" => array("text" => "Fruit eaten"));

	    $yourFirstChart["series"] = [
	        array("name" => "Jane", "data" => [1,0,4]),
	        array("name" => "John", "data" => [5,7,3])
	    ];
	    return view('administrador.dashboard', compact('yourFirstChart'));
	}
}
