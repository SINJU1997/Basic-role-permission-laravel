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
// create route for permission
Route::get('/permission','\App\Http\Controllers\EmployeeController@createPermission');
Route::group(['middleware' => ['can:view employees']], function () {
    Route::get('/employees','\App\Http\Controllers\EmployeeController@index');
});

Route::get('/register','\App\Http\Controllers\EmployeeController@create');
Route::post('/employee/register','\App\Http\Controllers\EmployeeController@store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
