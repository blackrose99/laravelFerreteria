<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;


Route::resource('clientes',ClienteController::class);


// Route::view('/', 'pages.home.home')->name('home');
// Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
