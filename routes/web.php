<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;

Route::get('/agenda/export-pdf', [AgendaController::class, 'exportPdf'])->name('agenda.export.pdf');


// Route::get('/', function () {
//     return view('dasboard');
// });

// Route::get('/agenda', function () {
//     return view('agenda');
// })->name('agenda');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth'])->group(function (){
    Route::get('/', function (){
        return view('dasboard');
    });

    Route::get('/agenda', function () {
        return view('agenda');
    })->name('agenda');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
