<?php

use Illuminate\Support\Facades\Route;


Route::prefix('api')
    ->middleware('api')
    ->namespace('App\Http\Controllers')
    ->group(base_path('routes/api.php'));
