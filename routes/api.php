<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('auth')->group(function () {
   

    Route::middleware('auth:api')->group(function () {
        // auth
        Route::post('/logout', [authController::class, 'logout']);
        Route::post('/refresh', [authController::class, 'refresh']);
        Route::get('/data', [authController::class, 'data']);

        // todo
        Route::post('/add', [TodoController::class, 'add']);
        Route::put('/update', [TodoController::class, 'update']);
        Route::get('/show', [TodoController::class, 'show']);
        Route::get('/find/{id}', [TodoController::class, 'findById']);
        Route::delete('/delete/{id}', [TodoController::class, 'delete']);
         // admin
        Route::middleware('isAdmin')->group(function () {
            Route::get('/showall', [TodoController::class, 'showAll']);
            Route::get('/showuser', [TodoController::class, 'showUser']);
            Route::delete('/deleteuser/{id}', [TodoController::class, 'deleteUser']);
        });
 
    });

});
Route::post('/login', [authController::class, 'login']);
Route::post('/regis', [authController::class, 'register']);



