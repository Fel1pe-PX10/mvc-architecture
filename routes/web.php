<?php 

use Lib\Route;

Route::get('/', function(){
    echo "hello world";
});

Route::get('/contacto', function(){
    echo "hello contact";
});

Route::get('/about', function(){
    echo "hello about";
});