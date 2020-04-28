<?php

use Illuminate\Support\Facades\Route;
use Presentation\Http\Actions;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/result', function () {
    return view('timeDeposit');
})->name('timeDeposit');

Route::post('calculate', Actions\TimeDeposit\TimeDepositAction::class)->name('timeDepositCalculator');
