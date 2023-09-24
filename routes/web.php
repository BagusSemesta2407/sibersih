<?php

use App\Http\Controllers\ActivityCategoryController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityDetailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'prevent-back-history'], function () {
    // Route::get('/', function () {
    //     return view('landingPage/index');
    // });

    Route::get('/', [LandingPageController::class, 'home'])->name('beranda');
    Route::get('get-activity/{id?}', [LandingPageController::class, 'getActivity'])->name('get-aktivitas');
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware('auth')->group(function () {
        Route::group(
            [
                'as' => 'operator.',
                'middleware' => ['role:operator'],
                'prefix' => 'operator'
            ],

            function () {
                // menu operator
                // operator is admin
                Route::resource('user', UserController::class);
                Route::resource('employee', EmployeeController::class);
                Route::post('tmp-image', [EmployeeController::class, 'tmpUpload'])->name('tmp-image');
                Route::resource('activity-categories', ActivityCategoryController::class);
                Route::resource('activities', ActivityController::class);
                Route::get('report', [ReportController::class, 'index'])->name('index-report');
                Route::get('pdf', [ReportController::class, 'pdf'])->name('pdf-activity');
            }
        );

        // menu pengguna
        // employee is pengguna (user)
        Route::group(
            [
                'as' => 'pengguna.',
                'middleware' => ['role:user'],
                'prefix' => 'pengguna'
            ],

            function () {
                Route::get('list-activity', [ActivityDetailController::class, 'index'])->name('index-list-activity');
                Route::get('create-activity-details/{id}', [ActivityDetailController::class, 'getActivity'])->name('get-activity');
                Route::post('create-activity-details/{id}', [ActivityDetailController::class, 'postActivityDetail'])->name('post-activity');
            }
        );
    });
});
