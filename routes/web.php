<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // untuk mendaftarkan user controler
use App\Http\Controllers\PositionController; // untuk mendaftarkan position controler
use App\Http\Controllers\DepartementController; // untuk mendaftarkan department controler
use App\Http\Controllers\PetugasJumatsController; // untuk mendaftarkan petugas jumat controler
use App\Http\Controllers\TransaksiController; // untuk mendaftarkan transaksi controler

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
//untuk mendftrkan link website

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(
    function () {
    Route::get('/', function () {return view('home', ['title' => 'Home']);})->name('home');
    Route::get('password', [UserController::class, 'password'])->name('password');
    Route::post('password', [UserController::class, 'password_action'])->name('password.action');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::resource('positions', PositionController::class);
    Route::get('position/export-excel', [PositionController::class, 'exportExcel'])->name('exportExcel');

    Route::resource('departements', DepartementController::class);
    Route::resource('user', UserController::class);
    Route::get('departement/export-pdf', [DepartementController::class, 'exportPdf'])->name('exportPdfDepartement');
    Route::get('users/exportpdf', [UserController::class, 'exportPDF'])->name('exportpdf'); 

    Route::resource('petugas_jumats', PetugasJumatsController::class);


    Route::resource('transaksi', TransaksiController::class);
    Route::get('/', [TransaksiController::class, 'chartLine'])->name('home');
    Route::get('chart-line-ajax', [TransaksiController::class, 'chartLineAjax'])->name('transaksi.chartLineAjax');
    Route::get('search/ptg', [PetugasJumatsController::class, 'autocomplete'])->name('search.ptg');
    Route::resource('petugas', PetugasJumatsController::class);
});