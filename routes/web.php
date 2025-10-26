<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;

Route::resource('perpustakaans', PerpustakaanController::class);

Route::get('/', function () {
    return view('welcome');
});

