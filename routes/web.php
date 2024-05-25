<?php 

use Lib\Route;

use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function(){
    return "hello contact";
});

Route::get('/about', function(){
    return "hello about";
});

Route::get('/courses/:slug', function($slug){
    return "hello courses ".$slug;
});

Route::dispatch();