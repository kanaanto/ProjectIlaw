<?php

class ClustersController extends \BaseController {

	public function __construct()
    {
        $this->beforeFilter('auth');
    }

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
		return "Create New Cluster";
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
			
			$clusters= Cluster::all();
			$clustersCount = Cluster::all()->count();
			
			//Get bulbs
			$bulbs = Bulb::all();
			$bulbsCount = Bulb::all()->count();

			//Get schedules
			$schedules = Schedule::all();
			$schedulesCount = Schedule::all()->count();

			$distinct_bulbs = array_fetch(DB::select("SELECT DISTINCT bulb_id FROM poweranalyzers ORDER BY bulb_id"),'bulb_id');
			$readings = Bulb::whereIn('id',$distinct_bulbs)->get();
			$readingsCount = count($readings);

			$markers = Cluster::find($id)->bulbs;
			$markersCount = count($markers);
			
			return View::make('cluster')->with('markers',$markers)->with('markersCount',$markersCount)->with('clusters',$clusters)->with('clustersCount',$clustersCount)->with('bulbs',$bulbs)->with('bulbsCount',$bulbsCount)->with('readings',$readings)->with('readingsCount',$readingsCount)->with('schedules',$schedules)->with('schedulesCount',$schedulesCount);
		
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
