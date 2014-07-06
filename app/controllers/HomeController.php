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

			$clusters= Cluster::all();
			$clustersCount = Cluster::all()->count();

			//Get bulbs
			$bulbs = Bulb::all();
			$bulbsCount = Bulb::all()->count();

			//Get distinct bulbs
			$distinct_bulbs = array_fetch(DB::select("SELECT DISTINCT bulb_id FROM poweranalyzers ORDER BY bulb_id"),'bulb_id');
			
			$readings = Bulb::whereIn('id',$distinct_bulbs)->get();
			$readingsCount = count($readings);

			//Get schedules
			$schedules = Schedule::all();
			$schedulesCount = Schedule::all()->count();

			return View::make('home')->with('markers',$markers)->with('markersCount',$markersCount)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
			
		}

		else {
			return Redirect::to('login');
		}

	}

}
