<?php

use App\Http\Controllers\ActivityCategoryController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityDetailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubangActivityController;
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
    Route::get('activity-all', [LandingPageController::class, 'indexActivity'])->name('index-activity');
    Route::get('activity-all/{id}', [LandingPageController::class, 'indexAxticityDetail'])->name('detail-activity');
    Route::get('get-activity/{id?}', [LandingPageController::class, 'getActivity'])->name('get-aktivitas');
    Route::get('schedule-information-activity/{id}', [LandingPageController::class, 'scheduleActivityDetail'])->name('schedule-information-detail');
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

                Route::get('activities/validate-waiting-status/{activity_status}', [ActivityController::class, 'validateWaitingStatus'])->name('validate-waiting-status');
                Route::post('activities/validate-waiting-status/{activity_status}', [ActivityController::class, 'formValidateWaitingStatus'])->name('post-validate-waiting-status');

                Route::get('activities/validate-upload-activity/{detail_activities}', [ActivityController::class, 'validateUploadActivityIndex'])->name('upload-validate-activity');
                Route::post('activities/validate-upload-activity/{detail_activities}', [ActivityController::class, 'validateUploadActivityForm'])->name('post-upload-validate-activity');

                Route::get('report', [ReportController::class, 'index'])->name('index-report');
                
                Route::get('pdf', [ReportController::class, 'exportPdf'])->name('pdf-activity');
                
                Route::resource('subang-sub-district-activity', SubangActivityController::class);
                
                Route::get('profile', [ProfilController::class, 'index'])->name('profile');
                
                Route::post('profile/{update}', [ProfilController::class, 'update'])->name('update-profile');
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
                Route::resource('activity', ActivityController::class);

                Route::get('activity/upload-activity/{activity_detail}', [ActivityController::class, 'getActivityForUpload'])->name('upload-activity');
                Route::post('activity/upload-activity/{activity_detail}', [ActivityController::class, 'postActivity'])->name('post-upload-activity');

                Route::get('activity/update-activity/{update_activity_details}', [ActivityController::class, 'uploadActivityEdit'])->name('update-upload-activity');
                Route::post('activity/update-activity/{update_activity_details}', [ActivityController::class, 'uploadActivityUpdate'])->name('post-update-upload-activity');

                Route::get('list-activity', [ActivityDetailController::class, 'index'])->name('index-list-activity');
             
                Route::get('create-activity-details/{id}', [ActivityDetailController::class, 'getActivity'])->name('get-activity');
                Route::post('create-activity-details/{id}', [ActivityDetailController::class, 'postActivityDetail'])->name('post-activity');
                
                Route::get('profile', [ProfilController::class, 'index'])->name('profile');
                Route::post('profile/{update}', [ProfilController::class, 'update'])->name('update-profile');
            }
        );
        Route::get('generate', function () {
            \Illuminate\Support\Facades\Artisan::call('storage:link');
            echo 'ok';
        });

        Route::get('optimize', function () {
            \Illuminate\Support\Facades\Artisan::call('optimize');
            echo 'ok';
        });
    });
});
