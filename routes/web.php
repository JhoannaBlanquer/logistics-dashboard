<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProximityAlertController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/proximity-form', [ProximityAlertController::class, 'showForm'])->name('proximity.form');

Route::post('/check-proximity', [ProximityAlertController::class, 'checkProximity'])->name('check.proximity');


