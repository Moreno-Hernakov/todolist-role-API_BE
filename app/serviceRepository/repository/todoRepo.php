<?php  
namespace App\serviceRepository\repository;
use App\Models\todo;
use App\Models\User;


Class todoRepo {
    
    public function getById($id){
      return todo::find($id);
    }

    public function showTodoUserAuth(){
      return todo::where('user_id', auth()->user()->id)->latest()->paginate(5);
    }

    public function showAllTodo(){
      return todo::get();
    }
    
    public function showUser(){
      return User::get();
    }
    
    public function deleteUser($id){
      return User::destroy($id);
    }
    
    public function getAll(){
      return todo::get();
    }

    public function create($data){
      return todo::create($data);
    }

    public function save($data){
      // $data['user_id'] = auth()->user()->id;
      // $this->todo->fill($data);
      // $this->todo = $data;
      // return $this->todo->save();
      // $id = $this->todo->save($data);
		// return $id;
      //  return todo::create($data);
    }

    public function update($data, $id){
       return todo::where('_id', $id)->update($data);
    }

    public function delete($id){
       return todo::destroy($id);
    }
}