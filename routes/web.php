<?php

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
    return view('welcome');
});
Auth::routes();

Route::get('/user-register',[\App\Http\Controllers\Auth\RegisterController::class, 'userRegister']);
Route::post('/user-register-store',[\App\Http\Controllers\Auth\RegisterController::class, 'userRegisterStore']);
    Route::group(['middleware' => ['web']], function () {
    Auth::routes(['verify' => true]);
    
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::post('/postLogin',[\App\Http\Controllers\Auth\LoginController::class, 'postLogin']);
    Route::get('check-username-exsist', [\App\Http\Controllers\CommonController::class, 'userNameExists']);
    Route::get('confirm_email', [\App\Http\Controllers\CommonController::class, 'confirmEmail']);
    Route::group(['middleware' => ['auth']], function () {

        Route::group(['prefix' => 'employer', 'middlewareGroups' => ['role:employer','web'], 'namespace' => 'Employer'], function () {
            // Dashboard
            Route::get('dashboard', [\App\Http\Controllers\Employer\DashboardController::class, 'index']);
            // Profile
            Route::get('profile', [\App\Http\Controllers\Employer\ProfileController::class, 'index']);
            Route::post('updateProfile',[\App\Http\Controllers\Employer\ProfileController::class, 'update']);

            // Post Jobs
            Route::get('posted-jobs', [\App\Http\Controllers\Employer\PostJobController::class,'index']);
            Route::get('posted-jobs/create', [\App\Http\Controllers\Employer\PostJobController::class,'create']);
            Route::post('posted-jobs/store', [\App\Http\Controllers\Employer\PostJobController::class,'store']);
            Route::get('posted-jobs/edit/{id}', [\App\Http\Controllers\Employer\PostJobController::class,'edit']);
            Route::post('posted-jobs/update/{id}', [\App\Http\Controllers\Employer\PostJobController::class,'update']);
            
        });
         Route::group(['prefix' => 'jobseeker', 'middlewareGroups' => ['role:jobseeker','web'], 'namespace' => 'Jobseeker'], function () {

            Route::get('dashboard', [\App\Http\Controllers\Jobseeker\DashboardController::class, 'dashboard']);
            Route::get('profile', [\App\Http\Controllers\Jobseeker\ProfileController::class, 'index']);
            Route::get('apply-job/{id}',[\App\Http\Controllers\Jobseeker\ApplyJobController::class, 'index']);
            Route::post('apply-job/store',[\App\Http\Controllers\Jobseeker\ApplyJobController::class, 'store']);
            Route::get('applied-jobs',[\App\Http\Controllers\Jobseeker\ApplyJobController::class, 'appliedJob']);
            Route::post('updateProfile',[\App\Http\Controllers\Jobseeker\ProfileController::class, 'update']);
            
        });
        
        
    });
});
