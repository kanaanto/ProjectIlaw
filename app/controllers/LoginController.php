<?php

class LoginController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /login
	 *
	 * @return Response
	 */
	public function index (){
      //If user is not yet logged in	 
      if(!Auth::check()){
   		 return View::make('login');
      }

      else {
        return Redirect::route('home.index');
      }
   
   	}

	/**
	 * Show the form for creating a new resource.
	 * GET /login/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /login
	 *
	 * @return Response
	 */
	public function store()
	{
		
      
	}

	/**
	 * Display the specified resource.
	 * GET /login/{id}
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
	 * GET /login/{id}/edit
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
	 * PUT /login/{id}
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
	 * DELETE /login/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function checklogin(){
      
         $username = Input::get('username');
         $password = Input::get('password');
         $rememberUser = Input::get('rememberUser');
         //echo $rememberUser;
         
         if (Auth::attempt(array('username' => $username,'password' => $password),true))
         {     
            Session::put('username',$username);
            return Redirect::route('home.index');
         }

         //Failed
         else 
         {	 
         	Notification::error('The page was saved.');
            return "hello";
         }  
      
   }

   public function logout(){
      Auth::logout();
      return Redirect::to('/');   
   }
}	