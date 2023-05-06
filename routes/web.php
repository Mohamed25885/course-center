<?php

use App\Http\Controllers\{CourseController, CourseCyclesController, CycleClassController, EnrollmentController, ExamController, ExamResultController, HomeController, ProfileController, StudentController, StudentEnrollmentController, TeacherController};
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
    return to_route('home');
});

Auth::routes();


Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('/teachers', TeacherController::class)->except(['show']);
    Route::resource('/courses', CourseController::class)->except(['show']);
    Route::resource('/students', StudentController::class)->except(['show']);
    Route::resource('/exams', ExamController::class)->except(['show']);
    Route::resource('/results', ExamResultController::class)->except(['show']);
    Route::get('/student-enrollments/{student}', StudentEnrollmentController::class)->name('student-enrollments');
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
        Route::prefix('classes')->as('classes.')->controller(CycleClassController::class)->group(function () {
            Route::get('/{courseCycles}', 'index')->name('index');
            Route::post('/{courseCycles}/new-class', 'store')->name('store');
            Route::put('/{courseCycles}/update/{cycleClass}', 'update')->name('update');
            Route::delete('/{courseCycles}/destroy/{cycleClass}', 'destroy')->name('destroy');
        });
    });
    Route::prefix('profile')->as('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
    });
});
