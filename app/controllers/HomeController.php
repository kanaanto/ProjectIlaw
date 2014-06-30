<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function index()
	{
		
		if(Auth::check()){
			
			//Get the markers
			$markers = Bulb::all();
			$markersCount = Bulb::all()->count();
			
			//Get clusters
			//$clusters = DB::table($cluster_tbl)->lists('clusterid','name');
			$clusters= Cluster::all();
			$clustersCount = Cluster::all()->count();

			
			//Get bulbs
			$bulbs = Bulb::all();
			$bulbsCount = Bulb::all()->count();


			//Get readings
			$readings = Poweranalyzer::all();
			$readingsCount = count($readings);


			//Get schedules
			$schedules = Schedule::all();
			$schedulesCount = Schedule::all()->count();

			return View::make('home')->with('markers',$markers)->with('markersCount',$markersCount)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
			//return $markers;
		}
		
	}

}
