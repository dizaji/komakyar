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
            Route::post('upload-display-picture', 'StudentController@uploadDisplayPicture')->name('upload-display-picture');
            Route::post('change-password', 'StudentController@changePassword')->name('change-password');
        });
        Route::resource('', 'StudentController', ['parameters' => ['' => 'student']]);
    });

    Route::group(['prefix' => 'lookup', 'as'=>'lookup.', 'namespace' => 'Lookup'], function (){
        Route::resource('academic-year', 'AcademicYearController', ['parameters' => ['academic-year' => 'year'], 'only' => ['index', 'show']]);
        Route::group(['prefix' => 'level-field', 'as'=>'level-field.', 'namespace' => 'LevelField'], function () {
            Route::resource('level', 'LevelController', ['only' => ['index', 'show']]);
            Route::resource('field', 'FieldController', ['only' => ['index', 'show']]);
            Route::resource('', 'LevelFieldController', ['parameters' => ['' => 'levelField'], 'only' => ['index', 'show']]);
        });
    });
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
