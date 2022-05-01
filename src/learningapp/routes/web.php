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

Route::get('sample', function () {
    return view('sample');
});

Route::get('ID/{id}', function($id) {
    echo "ID: $id";
});

Route::get('user/{name?}', function ($name = 'TutorialsPoint') {
    return "Name: $name";
});

Route::get('role', [
    'middleware' => 'Role:editor',
    'uses' => 'App\Http\Controllers\TestController@index',
 ]);

Route::get('terminate', [
    'middleware' => 'Role:editor',
    'uses' => 'App\Http\Controllers\TestController@index',
 ]);

 Route::get('terminate',[
    'middleware' => 'terminate',
    'uses' => 'App\Http\Controllers\ABCController@index',
 ]);

Route::get('blade/child', function() {
    return view('child');
});