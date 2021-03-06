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
Route::get('/degree/{degree}/course/{course}/edit', 'DegreeController@editCourse')->name('degree.courses.edit');
Route::put('/degree/{degree}/course/{course}/update', 'DegreeController@updateCourse')->name('degree.courses.update');
Route::post('/degree/{degree}/courses/store', 'DegreeController@storeCourse')->name('degree.courses.store');
Route::delete('/degree/{degree}/course/{course}/delete', 'DegreeController@deleteCourse')->name('degree.course.delete');
Route::get('/degree/{degree}/edit', 'DegreeController@edit')->name('degree.edit');
Route::put('/degree/{degree}/update', 'DegreeController@update')->name('degree.update');


// Meta-Courses
Route::get('/meta-course/index', 'MetaCourseController@index')->name('meta-course.index');
Route::get('/meta-course/create', 'MetaCourseController@create')->name('meta-course.create');
Route::post('/meta-course/store', 'MetaCourseController@store')->name('meta-course.store');
Route::get('/meta-course/{metaCourse}/edit', 'MetaCourseController@edit')->name('meta-course.edit');
Route::put('/meta-course/{metaCourse}/update', 'MetaCourseController@update')->name('meta-course.update');
Route::delete('/meta-course/{metaCourse}/delete', 'MetaCourseController@delete')->name('meta-course.delete');
