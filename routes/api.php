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

Route::get('categories/custom1','Api\CategoryController@custom1');
Route::get('products/custom1','Api\ProductController@custom1');
Route::get('products/custom2','Api\ProductController@custom2');
Route::get('products/custom3','Api\ProductController@custom3');
Route::get('categories/report1','Api\CategoryController@report1');

Route::apiResource("/products",'Api\ProductController');
Route::apiResource("/users","Api\UserController");
Route::apiResource("/categories","Api\CategoryController");

/*
Route::apiResource([
    "products" => "Api\ProductController",
    "users" => "Api\UserController"
]);
*/

Route::apiResource("/comments","Api\CommentController");

Route::apiResource("/likes","Api\LikeController");







