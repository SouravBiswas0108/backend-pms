<?php

use App\Http\Controllers\Department\UserDepartmentController;
use App\Http\Controllers\EmployeeSubTaskController;
use App\Http\Controllers\personalInfo\PersonalInfoController;
// use App\Http\Controllers\PlanningController;
// use App\Http\Controllers\Planning\PlanningController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Planning\PlanningController;
use App\Models\EmployeeSubTask;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth');
    Route::post('register', 'register');
    // Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

// Route::resource('planning', PlanningController::class);

// // Route::resource('employeetask',EmployeeSubTaskController::class);

// Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->group(function () {
    // Resource routes

    // Route::resource('employeetask', EmployeeSubTaskController::class);
    Route::resource('personalinfo', PersonalInfoController::class);
    Route::post('security',[PersonalInfoController::class,'security'])->name('security');

    Route::resource('department', UserDepartmentController::class);

    Route::prefix('planning')->name('planning.')->group(function () {
        Route::resource('/', PlanningController::class);
        Route::get('employeetask', [PlanningController::class, 'employeeTask'])->name('employeeTask');
    });
    
    

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Route::get('/test', function () {
//     dd(123);
// });



