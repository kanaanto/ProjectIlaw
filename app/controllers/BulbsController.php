<?php

class BulbsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		if(Auth::check()){
			
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

			return View::make('add_bulb')->with('markers',$markers)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
			//return $marker;
			
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Create a new light/lamp
		return Input::get('longtitude');
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Auth::check()){
			
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
