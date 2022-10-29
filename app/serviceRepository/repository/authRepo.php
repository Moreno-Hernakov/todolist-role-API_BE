<?php  
namespace App\serviceRepository\repository;
use App\Models\User;


Class authRepo {
    
    public function register($data){
        // return $data;
        return User::create($data);
    }
}