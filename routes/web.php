<?php
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
    //return redirect()->route('category.show',['slug' => 'books']);
});

Route::prefix('basics')->group(function(){

    Route::get('/test',function (){
        return view('test');
    });

    Route::get('category/{slug}',function ($slug){
        return "Category Slug: ".$slug;
    })->name('category.show');

});


Route::get('/product/{id}/{type?}','ProductController@show')->name('product.show');

Route::resource('/products','ProductController');
//Route::resource('/products','ProductController')->only(['index','show']);
//Route::resource('/products','ProductController')->except(['destroy']);



