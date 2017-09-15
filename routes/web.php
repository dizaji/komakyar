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
        Route::group(['prefix' => '{group}'], function () {
            Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
                Route::get('{student}/add', 'StudentController@add')->name('add');
                Route::resource('', 'StudentController', ['parameters' => ['' => 'student'], 'only' => ['index', 'destroy']]);
            });
            Route::group(['prefix' => 'course', 'as' => 'course', 'namespace' => 'Course'], function () {
                Route::resource('presentation', 'PresentationController', ['parameters' => ['presentation' => 'groupPresentedCourse'], 'except' => ['create', 'update']]);
            });
        });
        Route::resource('', 'GroupController', ['parameters' => ['' => 'group'], 'except' => ['create', 'edit']]);
    });
    Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student'], function () {
        Route::group(['prefix' => '{student}'], function () {
            Route::resource('parent', 'ParentController', ['except' => ['create', 'edit', 'show']]);
            Route::post('upload-display-picture', 'StudentController@uploadDisplayPicture')->name('upload-display-picture');
            Route::post('change-password', 'StudentController@changePassword')->name('change-password');
        });
        Route::resource('', 'StudentController', ['parameters' => ['' => 'student'], 'except' => ['create', 'edit']]);
    });

    Route::group(['prefix' => 'lookup', 'as' => 'lookup.', 'namespace' => 'Lookup'], function () {
        Route::resource('academic-year', 'AcademicYearController', ['parameters' => ['academic-year' => 'year'], 'only' => ['index', 'show']]);
        Route::group(['prefix' => 'level-field', 'as' => 'level-field.', 'namespace' => 'LevelField'], function () {
            Route::resource('level', 'LevelController', ['only' => ['index', 'show']]);
            Route::resource('field', 'FieldController', ['only' => ['index', 'show']]);
            Route::resource('', 'LevelFieldController', ['parameters' => ['' => 'levelField'], 'only' => ['index', 'show']]);
        });
        Route::group(['prefix' => 'course', 'as' => 'course.', 'namespace' => 'Course'], function () {
            Route::resource('presentation', 'PresentationController', ['only' => ['index', 'show']]);
            Route::resource('', 'CourseController', ['parameters' => ['' => 'course'], 'except' => ['create', 'show', 'edit']]);
        });
    });
    Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'namespace' => 'Teacher'], function () {
        Route::group(['prefix' => '{teacher}'], function () {
            Route::post('upload-display-picture', 'TeacherController@uploadDisplayPicture')->name('upload-display-picture');
            Route::post('change-password', 'TeacherController@changePassword')->name('change-password');
        });
        Route::resource('', 'TeacherController', ['parameters' => ['' => 'teacher'], 'except' => ['create', 'edit']]);
    });
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
