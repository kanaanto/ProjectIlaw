<?php 

class UserController extends BaseController {

   public function index (){
   		 
   		 return View::make('login');
   }


   public function checklogin(){

         $username = Input::get('username');
         $password = Input::get('password');
         
         if (Auth::attempt(array('username' => $username,'password' => $password)))
         {     
            
            Session::put('username',$username);
            return Redirect::intended('home');
         
         }

         else 
         {
            //return $password;
            return Redirect::to('login');
         }

   }

   public function logout(){
      Auth::logout();
      return Redirect::to('login');
      
   }

}