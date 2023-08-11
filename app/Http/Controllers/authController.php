<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\serviceRepository\service\authService;

class authController extends Controller
{
    public function __construct() {
        $this->authService = new authService();
    }
    
    public function register(Request $request){
        $data = $request->validate([
			'name'=>'required|min:6',
			'email'=>'required|email',
			'password'=>'required|min:6',
		]);
    
        $data['role'] = 'user';
        $data['password'] = bcrypt($request->password);

        $user = $this->authService->regis($data);
        
        return response()->json([
            "data" => $user,
            "message" => "User berhasil ditambahkan",
            "success" => true,
        ]);
    }

    public function login(Request $request){
        $request->validate([
			'email'=>'required|email',
			'password'=>'required|min:6',
		]);
        $credentials = request(['email', 'password']);
        // dd($credentials);
        $token = $this->authService->attempt($credentials);
        // $token = auth()->attempt($credentials);
        if(!$token){
            return response()->json(['error' => 'password do not match'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3600
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout(){
        // auth()->logout();
        $this->authService->logout();

        return response()->json([
            "message" => "Successfully logout"
        ], 200);
    }

    public function refresh(){
        return response()->json([
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function data(){
        $auth = $this->authService->userAuth();
        return response()->json($auth);
    }
}
