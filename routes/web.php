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
Route::get('/pie', function () {
    return view('component.Pie');
})->name('pie');
Route::get('/auto-bar', function () {
    return view('component.AutoBar');
})->name('Auto-Bar');

Route::get('/trend', function () {
    return view('component.Trend');
})->name('trend');
Route::get('/compare/{firstdate}/{seconddate}', 'QrCodeController@comparison')->name('date-comparision');



