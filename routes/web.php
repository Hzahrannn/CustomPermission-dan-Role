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

//Route Pindah Laman
Route::get('/','ViewController@home');
Route::get('/vote', 'ViewController@vote')->middleware('auth');
Route::get('/login', 'ViewController@login')->middleware('guest')->name('login');
Route::get('/hitung', 'ViewController@hitung')->middleware('auth');
Route::get('/operator/operator/operator', 'ViewController@op')->middleware('auth');
Route::get('/register/registereuy', 'ViewController@register');
Route::get('/logout', 'ViewController@logout');

Route::get('/ajukan/{id}', 'ViewController@ajukan')->middleware('auth');
Route::get('/batalkan/{id}', 'ViewController@batalkan')->middleware('auth');

Route::post('/login/masuk', 'ViewController@masuk');
Route::post('/register/register', 'ViewController@reg');
Route::post('/vote/masuk', 'ViewController@hitungsuara')->middleware('auth');

Route::get('/cuspermis', 'PermisController@home')->middleware('auth');
Route::get('/buatrole', 'PermisController@buatrole')->middleware('auth');
Route::get('/buatcus', 'PermisController@buatcus')->middleware('auth');
Route::get('/buatur', 'PermisController@buatur')->middleware('auth');

Route::post('/buatrole/buat', 'PermisController@role')->middleware('auth');
Route::post('/c/buat', 'PermisController@c')->middleware('auth');
Route::post('/r/buat', 'PermisController@r')->middleware('auth');