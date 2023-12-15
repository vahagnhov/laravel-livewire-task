<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\MultiStepForm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/multi-step-form', MultiStepForm::class)->name('multi-step-form');
