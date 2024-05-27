<?php

use App\Controllers\ContactController;
use App\Controllers\HomeController;

use Lib\Route;

Route::get('/', [HomeController::class, 'index']);

// Contact Routes ------------------------------------------------------

Route::get('/contacts', [ContactController::class, 'index']);

Route::get('/contacts/create', [ContactController::class, 'create']);

Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/contacts/:id', [ContactController::class, 'show']);

Route::get('/contacts/:id/edit', [ContactController::class, 'edit']);

Route::post('/contacts/:id', [ContactController::class, 'update']);

Route::post('/contacts/:id/delete', [ContactController::class, 'destoy']);

Route::dispatch();