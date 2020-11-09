<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\RecordingController;

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
Route::get('/guides', 'GuideController@index')->name('guides.index');
Route::post('/guides', 'GuideController@store')->name('guides.store');
Route::get('/guides/create', 'GuideController@create')->name('guides.create');
Route::get('/guides/{guide}', 'GuideController@show')->name('guides.show');
Route::get('/guides/{guide}/download', 'GuideController@download')->name('guides.download');
Route::get('/guides/{guide}/edit', 'GuideController@edit')->name('guides.edit');
Route::put('/guides/{guide}', 'GuideController@update')->name('guides.update');
Route::get('/guides/{guide}/destroy', 'GuideController@destroy')->name('guides.destroy');

Route::get('/recordings', 'RecordingController@index')->name('recordings.index');
Route::post('/recordings', 'RecordingController@store')->name('recordings.store');
Route::get('/recordings/create', 'RecordingController@create')->name('recordings.create');
Route::get('/recordings/{recording}', 'RecordingController@show')->name('recordings.show');
Route::get('/recordings/{recording}/download', 'RecordingController@download')->name('recordings.download');
Route::get('/recordings/{recording}/edit', 'RecordingController@edit')->name('recordings.edit');
Route::put('/recordings/{recording}', 'RecordingController@update')->name('recordings.update');
Route::get('/recordings/{recording}/destroy', 'RecordingController@destroy')->name('recordings.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
