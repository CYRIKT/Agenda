<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/agenda', AgendaController::class);

