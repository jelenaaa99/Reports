<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\XMLContoller;
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

Route::get('/', function () {
    return view('pages.reports');
})->name('home');
Route::get('/excel', [ExcelController::class, 'downloadExcel'])->name('download-excel');
Route::get('/xml', [XMLContoller::class, 'getXML'])->name('download-xml');
