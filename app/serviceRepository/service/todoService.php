<?php  
namespace App\serviceRepository\service;

use App\serviceRepository\repository\todoRepo;

Class todoService {

    public function __construct(){
        $this->todoRepo = new todoRepo();
    }

    // for user
    public function getById($id){
		return $this->todoRepo->getById($id);
    }

    public function getTodo(){
        return $this->todoRepo->getAll();
    }

    public function addTodo($data){
        return $this->todoRepo->create($data);
    }

    public function updateTodo($data, $id){
        return $this->todoRepo->update($data, $id);
    }

    public function deleteTodo($id){
        return $this->todoRepo->delete($id);
    }

    public function showTodoAuth(){
        return $this->todoRepo->showTodoUserAuth();
    }

    // for admin
    public function showTodo(){
        return $this->todoRepo->showAllTodo();
    }

    public function showUser(){
        return $this->todoRepo->showUser();
    }

    public function delUser($id){
        return $this->todoRepo->deleteUser($id);
    }
}