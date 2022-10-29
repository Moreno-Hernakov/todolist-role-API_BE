<?php  
namespace App\serviceRepository\service;

use App\serviceRepository\repository\authRepo;

Class authService {

    public function __construct(){
        $this->authRepo = new authRepo();
    }

    // for user
    public function regis($data){
		  return $this->authRepo->register($data);
    }

    public function attempt($data){
		  return auth()->attempt($data);
    }

    public function logout(){
		  return auth()->logout();
    }
    
    public function userAuth(){
		  return auth()->user();
    }

}