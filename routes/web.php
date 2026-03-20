<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/', function () {
	return redirect()->route('animes.index');
});

Route::resource('animes', AnimeController::class);