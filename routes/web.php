<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Login Routes
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('loginsubmit', [AuthController::class, 'loginSubmit'])->name('loginsubmit');

    //admin Dashboard
    Route::middleware(['CheckAuth'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Route::get('users', [UserController::class, 'index'])->name('users');
        // Route::post('/users/create', [UserController::class,'create'])->name('userscreate');
        Route::resource('users',UserController::class);
        Route::post('yearfilterSessionSave',[UserController::class,'sessionYearSave']);

        //department
        Route::resource('departments',DepartmentController::class);
        Route::get('/department/assignuserRole/{department}',[DepartmentController::class,'assignUserRole'])->name('assignUserRole');


        Route::post('updateprofile',[UserController::class,'updateProfile'])->name('updateProfile');
        Route::post('userpassword',[UserController::class,'userpassword'])->name('userPassword');
        

    });
});
