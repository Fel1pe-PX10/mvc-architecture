<?php 

use Lib\Route;

Route::get('/', function(){
    return [
        "test" => 'otro',
        "como" => 'este'
    ];
});

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