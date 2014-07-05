<?php

class ClustersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
			//$marker = Bulb::find($id);
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

			//$markers = Clusterbulb::find($id);
			//$markers = Bulb::g
			//$markers = Bulb::find($id)->cluster_bulb;
			//$markers = Bulb::find($id)->cluster_bulb;
			$markers = DB::select("SELECT id, address, latitude, longitude, state, name FROM bulb WHERE id IN (SELECT bulb_id FROM cluster_bulb WHERE id=$id)");
			$markersCount = count($markers);

			return View::make('cluster')->with('markers',$markers)->with('markersCount',$markersCount)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
			//return $markers;
			//return $markersCount;
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
