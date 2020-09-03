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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('index');
});
Route::post('/todos', 'TodoController@store')->name('todo.store');
Route::get('/todos', 'TodoController@index')->name('todo.index');
Route::get('/todos/edit/{id}', 'TodoController@edit')->name('todo.edit');
Route::post('/todos/update/{id}', 'TodoController@update')->name('todo.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
