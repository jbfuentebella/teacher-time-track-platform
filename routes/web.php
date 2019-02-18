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

// teacher
Route::get('/clock-in', 'TeacherController@create')->name('clock-in.create');
Route::post('/clock-in', 'TeacherController@store')->name('clock-in.store');
Route::get('/clock-out', 'TeacherController@edit')->name('clock-out.edit');
Route::patch('/clock-out', 'TeacherController@update')->name('clock-out.update');
Route::get('/clock-success/{slug}', 'TeacherController@show')->name('clock-success.show');
Route::get('/teachers', 'TeacherController@index')->name('teachers.index');

// teacher - registration
Route::get('/register-new-teacher', 'TeacherRegistrationController@create')->name('teacher-registration.create');
Route::post('/register-new-teacher', 'TeacherRegistrationController@store')->name('teacher-registration.store');

// verification - teacher
Route::get('/verify-account/{token}', 'VerifyController@edit')->name('verify.edit');

// admin
Route::resource('admins', 'AdminController', ['except' => [
    'show', 'edit', 'update', 'destroy'
]]);
Route::get('/admins/{slug}', 'AdminController@show')->name('admins.show');
Route::get('/admins/{slug}/edit', 'AdminController@edit')->name('admins.edit');
Route::patch('/admins/{slug}', 'AdminController@update')->name('admins.update');
Route::delete('/admins/{slug}', 'AdminController@destroy')->name('admins.destroy');

// Accounts - Change Status
Route::patch('/accounts-change-status/{slug}', 'AccountChangeStatusController@update')
    ->name('accounts-change-status.update');

// Accounts - Change Password
Route::get('/accounts-change-password/{slug}/edit', 'AccountChangePasswordController@edit')
    ->name('accounts-change-password.edit');
Route::patch('/accounts-change-password/{slug}', 'AccountChangePasswordController@update')
    ->name('accounts-change-password.update');



