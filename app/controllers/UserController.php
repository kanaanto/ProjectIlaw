<?php 

class UserController extends BaseController {

   public function index (){
   		 
   		 return View::make('login');
   }


   public function checklogin(){
   		
   		$username = Input::get('username');
		
   		$count = User::where('username','=',$username)->where('password','=',Input::get('password'))->count();

   		if($count==1){

   			//Set session
   			Session::put('username',$username);
   			Session::put('loggedIn',true);
   			
   			return Redirect::to('home');
   		}
   		

   		else 
   		{
   			Session::put('loggedIn',false);
   			return Redirect::to('login');
   		}

   }

}