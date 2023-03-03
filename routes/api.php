<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product',[TestingController::class,'product']); //for all product
//localhost:8000/api/product

Route::get('detail',[TestingController::class,'detail']);// for all table //Read
//localhost:8000/api/detail

Route::get('category/read',[TestingController::class,'readCategory']); //Read *
//localhost:8000/api/category/read

Route::get('category/read/{id}',[TestingController::class,'readCategoryID']); //Read with id
//localhost:8000/api/category/read

Route::post('createCategory',[TestingController::class,'createCategory']); //Create
//localhost:8000/api/createCategory

Route::get('category/delete/{id}',[TestingController::class,'deleteCategory']); //Delete
//localhost:8000/api/category/delete

Route::post('category/update',[TestingController::class,'updateCategory']);//Update
//localhost:8000/api/category/update
//name=>category_name
