<?php

class SessionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /sessions
	 *
	 * @return Response
	 */
	public function index (){
   	
      //If user is not yet logged in	 
      if(Auth::guest()){
   		 return View::make('login');
      }

      else {
        return Redirect::route('home.index');
      }
   
   	}

	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
		$username = Input::get('username');
	    $password = Input::get('password');
	    $rememberUser = Input::get('rememberUser');
	     
	    if (Auth::attempt(array('username' => $username,'password' => $password),true))
	    {     
	        Session::put('username',$username);
	        return Redirect::route('home.index');
	    }
	    
	    //Flash::error('Login error');
	    return Redirect::back()->withInput();
	}

	/**
	 * Display the specified resource.
	 * GET /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /sessions/{id}/edit
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
	 * PUT /sessions/{id}
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
	 * DELETE /sessions/{id}
	 *
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
      	return Redirect::route('index');
	}

}