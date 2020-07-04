<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/merhaba',function (){
    return "Merhaba Api";
});

Route::get('/users',function (){
    return factory(User::class,10)->make();
});

Route::apiResource("/products",'Api\ProductController');
Route::apiResource("/users","Api\UserController");
Route::apiResource("/categories","Api\CategoryController");

/*
Route::apiResource([
    "products" => "Api\ProductController",
    "users" => "Api\UserController"
]);
*/
