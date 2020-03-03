<?php

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', 'DashboardController@landing');
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
Route::get('/reports', 'FirebaseController@index')->middleware('auth');
Route::get('/download', 'FirebaseController@static_array_to_csv')->middleware('auth');
Route::get('/profile', 'DashboardController@profile')->middleware('auth');
Route::post('/delete', 'FirebaseController@delete')->name('reports.delete')->middleware('auth');

//adminLTE routes
Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');
