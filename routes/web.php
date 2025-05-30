<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\FormController;

Route::get('/', [FormController::class, 'index']);
Route::post('/submit-form', [FormController::class, 'submit'])->name('form.submit');


Route::get('/', function () {
    return view('landing');
});

Route::post('/submit-form', [FormController::class, 'submit'])->name('form.submit');
