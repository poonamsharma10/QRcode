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

Route::get('/qrcode', 'QrCodeController@index')->name('qrcode');
Route::get('/chart/{slug}','QrCodeController@chart')->name('chart');

Route::get('/', function () {
    return view('component.Home');
});
Route::get('/line', function () {
    return view('component.Line');
})->name('line');
Route::get('/bar', function () {
    return view('component.Bar');
})->name('bar');

