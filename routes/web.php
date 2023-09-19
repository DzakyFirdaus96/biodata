<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaDidikR;
use App\Http\Controllers\GuruP;
use App\Http\Controllers\PesertaDidikPDF;
use App\Http\Controllers\UserC;

route::get('pesertadidik/pdf', [PesertaDidikPDF::class, 'pdf'])
->middleware('auth');
route::resource('pesertadidik', PesertaDidikR::class)
->middleware('auth');

// route::get('pdf', [PesertaDidikPDF::class, 'pdf']);

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::resource('pesertadidik', PesertaDidikR::class);
Route::resource('guru', GuruP::class);

route::get('register', [UserC::class, 'register'])->name('register');
route::get('login', [UserC::class, 'login'])->name('login');
Route::post('register', [UserC::class, 'register_action'])->name('register.action');
Route::post('login', [UserC::class, 'login_action'])->name('login.action');
Route::get('logout', [UserC::class, 'logout'])->name('logout');