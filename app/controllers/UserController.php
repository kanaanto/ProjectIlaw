<?php 

class UserController extends BaseController {

   public function index (){
   	
      //If user is not yet logged in	 
      if(!Auth::check()){
   		 return View::make('login');
      }

      else {
         return Redirect::to('home');
      }


   
   }

   public function checklogin(){
      
         $username = Input::get('username');
         $password = Input::get('password');
         $rememberUser = Input::get('rememberUser');
         //echo $rememberUser;
         
         if (Auth::attempt(array('username' => $username,'password' => $password),true))
         {     
            Session::put('username',$username);
            return Redirect::intended('home');
         }

         else 
         {
            return Redirect::to('login');
         }  
      

   }

   public function logout(){
      Auth::logout();
      return Redirect::to('login');   
   }

}