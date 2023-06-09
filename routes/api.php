<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\dumyApi;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;

use App\Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get("data",[dumyApi::class,'getData']);

// Route::get('devices',[DeviceController::class,'list']);
// Route::post("devices",[DeviceController::class,'add']);
// Route::put("/device/update/{id}",[DeviceController::class,'update']);
// Route::delete("/device/delete/{id}", [DeviceController::class, 'delete']);
// Route::get("/devices/search/{key}",[DeviceController::class, 'search']);

/// using Resource
// Route::apiResource("member", MemberController::class);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::apiResource("member", MemberController::class);

    //
    Route::get('devices', [DeviceController::class, 'list']);
    Route::post("devices", [DeviceController::class, 'add']);
    Route::put("/device/update/{id}", [DeviceController::class, 'update']);
    Route::delete("/device/delete/{id}", [DeviceController::class, 'delete']);
    Route::get("/devices/search/{key}", [DeviceController::class, 'search']);


});
// Route::apiResource("member", MemberController::class)->middleware(['middleware' => 'auth:sanctum']);
Route::post("login",[UserController::class,'index']);
Route::post("register",[UserController::class,'register']);

Route::post("upload", [FileController::class, 'upload']);



Route::get('anonymous',[AnonymousController::class,'index']);
Route::post('anonymous',[AnonymousController::class,'loginAnonymous']);
//show
Route::get('ahttp://localhost/be-app/public/api/postsnonymous/{id}',[AnonymousController::class,'show']);

//post
Route::get('posts',[PostController::class,'index']);
Route::group(['middleware'=>'auth:sanctum'],function(){
    
    Route::post('posts',[PostController::class,'store']);
    Route::put('posts/{id}',[PostController::class,'update']);
    Route::delete('posts/{id}',[PostController::class,'destroy']);
});
Route::get('posts-by/{user_id}',[PostController::class,'getByUserId']);
Route::get('posts/{id}',[PostController::class,'show']);


/// policy
Route::get('policies',[PolicyController::class,'index']);
Route::get('policy/{id}',[PolicyController::class,'show']);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('policies',[PolicyController::class,'store']);
    Route::put('policy/{id}',[PolicyController::class,'update']);
    Route::delete('policy/{id}',[PolicyController::class,'destroy']);
});

/// category
Route::get('categories',[CategoryController::class,'index']);
Route::get('category/{id}',[CategoryController::class,'show']);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('categories',[CategoryController::class,'store']);
    Route::put('category/{id}',[CategoryController::class,'show']);
    Route::delete('category/{id}',[CategoryController::class,'destroy']);
});

/// category
Route::get('products',[ProductController::class,'index']);
Route::get('product/{id}',[ProductController::class,'show']);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('products',[ProductController::class,'store']);
});