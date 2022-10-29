<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todo;
use App\Models\User;
use App\serviceRepository\service\todoService;

class TodoController extends Controller
{   
    public function __construct() {
        $this->todoService = new todoService();
    }

    // user
    public function add( Request $request ){
        $request->validate([
			'todo'=>'required'
		]);

        $data = [
            "todo" => $request->post('todo'),
            "user_id" => auth()->user()->id
        ];
        
        $this->todoService->addTodo($data);

        return response()->json([
            "data" => $data,
            "message" => "todo berhasil ditambahkan",
            "success" => true,
        ], 200);
    }

    public function update( Request $request ){
        $request->validate([
			'todo'=>'required',
			'id'=>'required'
		]);

        $data = [
            'todo' => $request->post('todo')
        ];
        $this->todoService->updateTodo($data, $request->post('id'));

        $todo = $this->todoService->getById($request->post('id'));

        return response()->json([
            "data" => $todo,
            "message" => "todo berhasil diperbarui",
            "success" => true,
        ], 200);
    }

    public function delete( $id ){
        $this->todoService->deleteTodo($id);

        return response()->json([
            "message" => "todo berhasil dihapus",
            "success" => true
        ], 200);
    }

    public function show(){
        $todo = $this->todoService->showTodoAuth();
        return response()->json($todo);
    }

    public function findById($id){
        $todo = $this->todoService->getById($id);
        return response()->json($todo);
    }


    // admin
    public function showAll(){
        $todo = $this->todoService->showTodo();
        return response()->json($todo);
    }

    public function showUser(){
        $user = $this->todoService->showUser();
        return response()->json($user);
    }
    
    public function deleteUser($id){
        $this->todoService->delUser($id);
        return response()->json([
            "message" => "user berhasil dihapus",
            "success" => true
        ], 200);
    }

}
