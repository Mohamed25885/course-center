<?php

use App\Http\Controllers\{CourseController, CourseCyclesController, EnrollmentController, HomeController, StudentController, TeacherController};
use Illuminate\Support\Facades\Auth;
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
    return view('landingpage');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/teachers', TeacherController::class)->except(['show']);
Route::resource('/courses', CourseController::class)->except(['show']);
Route::resource('/students', StudentController::class)->except(['show']);
Route::prefix('/cycles')->as('cycles.')->controller(CourseCyclesController::class)->group(function () {
    Route::post('/{course}/store', 'store')->name('store');
    Route::delete('/{courseCycles}/destroy', 'destroy')->name('destroy');
    Route::put('/{course}/update/{courseCycles}', 'update')->name('update');
    Route::prefix('enrollments')->as('enrollments.')->controller(EnrollmentController::class)->group(function () {
        Route::get('/{courseCycles}', 'index')->name('index');
        Route::post('/{courseCycles}', 'store')->name('store');
        Route::put('/{courseCycles}/update/{enrollment}', 'update')->name('update');
        Route::delete('/{enrollment}/destroy', 'destroy')->name('destroy');
    });
});
