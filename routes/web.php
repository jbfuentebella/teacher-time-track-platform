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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// registration
Route::get('/register-new-teacher', 'TeacherRegistrationController@create')->name('teacher-registration.create');
Route::post('/register-new-teacher', 'TeacherRegistrationController@store')->name('teacher-registration.store');

// verification - teacher
Route::get('/verify-new-teacher/{token}', 'TeacherRegistrationController@edit')->name('teacher-registration.edit');



