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
    return redirect()->route('degree.index');
});

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

// Degrees
Route::get('/degree/index', 'DegreeController@index')->name('degree.index');
Route::get('/degree/create', 'DegreeController@create')->name('degree.create');
Route::post('/degree/store', 'DegreeController@store')->name('degree.store');
Route::get('/degree/{degree}/courses', 'DegreeController@courses')->name('degree.courses');
Route::post('/degree/{degree}/courses/store', 'DegreeController@storeCourse')->name('degree.courses.store');
Route::get('/degree/{degree}/edit', 'DegreeController@edit')->name('degree.edit');
Route::put('/degree/{degree}/update', 'DegreeController@update')->name('degree.update');


// Meta-Courses
Route::get('/meta-course/index', 'MetaCourseController@index')->name('meta-course.index');
Route::get('/meta-course/create', 'MetaCourseController@create')->name('meta-course.create');
Route::post('/meta-course/store', 'MetaCourseController@store')->name('meta-course.store');
Route::get('/meta-course/edit', 'MetaCourseController@edit')->name('meta-course.edit');
Route::put('/meta-course/update', 'MetaCourseController@update')->name('meta-course.update');
Route::put('/meta-course/delete', 'MetaCourseController@delete')->name('meta-course.update');