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

Route::group(['prefix' => 'staff', 'as' => 'staff.', 'namespace' => 'Staff', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'group', 'as' => 'group.', 'namespace' => 'Group'], function () {
        Route::resource('', 'GroupController', ['parameters' => ['' => 'group']]);
    });
    Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student'], function () {
        Route::group(['prefix' => '{student}'], function () {
            Route::resource('parent', 'ParentController', ['except' => ['create', 'edit', 'show']]);
        });
        Route::resource('', 'StudentController', ['parameters' => ['' => 'student']]);
    });
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
