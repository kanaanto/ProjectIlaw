<?php

class BulbsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		//Get the markers
		$markers = Bulb::all();
		
		//Get clusters
		//$clusters = DB::table($cluster_tbl)->lists('clusterid','name');
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

		return View::make('get_coordinate')->with('markers',$markers)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
			
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Create a new light/lamp
		
		$longitude = Input::get('longitude');
		$latitude = Input::get('latitude');
		
		//Assign coordinates to $marker array
		$marker = array('longitude' => $longitude, 'latitude' => $latitude);

		//Get clusters
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

		return View::make('add_bulb')->with('marker',$marker)->with('longitude',$longitude)->with('latitude',$latitude)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Define new bulb
		$bulb = new Bulb;

		$bulb->name = Input::get('name');
		$bulb->ip = Input::get('ip');
		$bulb->address = Input::get('address');
		$bulb->latitude = Input::get('latitude');
		$bulb->longitude = Input::get('longitude');

		$bulb->save();
		
		$newBulbId = $bulb->id;
		
		//Add to new cluster
		//If existing
		if(Input::get('optionsRadios')=='existing'){
			
			$cluster_id = Input::get('existingClusters');
			$cluster = Cluster::find($cluster_id);
			
			$cluster->bulbs()->attach($newBulbId);
		}

		else {
			
			$cluster = new Cluster;
			$cluster->name = Input::get('newCluster');
			
			$cluster->save();
			
			$newClusterId = $cluster->id;

			$newCluster = Cluster::find($newClusterId);

			$cluster->bulbs()->attach($newBulbId);
			

		}

		return Redirect::route('home.index');
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{		
		//Get the markers
		$marker = Bulb::find($id);
		
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

		return View::make('bulb')->with('marker',$marker)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
		//return $marker;
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
