<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;

// Welcome page
Route::get('/', [HomeController::class, 'index']);

// Registration
Route::get('reg', [AuthController::class, 'reg']);
Route::post('reg_post', [AuthController::class, 'reg_post']);

// Login
Route::get('login', [AuthController::class, 'login']);
Route::post('login_post', [AuthController::class, 'login_post']);

// Forget
Route::get('forget', [AuthController::class, 'forget']);
Route::post('forget_post', [AuthController::class, 'forget_post']);

// Reset
Route::get('reset/{token}', [AuthController::class, 'getReset']);
Route::post('reset_post/{token}', [AuthController::class, 'postReset']);

// Middleware for authenticated users
Route::group(['middleware' => 'auth'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('logout', [AuthController::class, 'logout']);


    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Task routes
    Route::get('/mes-taches', [TaskController::class, 'myTasks'])->name('tasks.my_tasks');
    // Route::resource('tasks', TaskController::class)->middleware('user');

    // Team routes
    Route::get('/my-teams', [TeamController::class, 'myTeams'])->name('teams.my_teams');

    // Middleware for manager
    // Route::group(['middleware' => 'manager'], function () {
    //     Route::resource('projects', ProjectController::class);
    //     Route::resource('teams', TeamController::class);
    //     Route::resource('tasks', TaskController::class);
    // });

    Route::get('manager/dashboard', [DashboardController::class, 'managerDashboard'])->middleware('manager')->name('manager.dashboard');
    // Middleware for admin
    Route::group(['middleware' => 'Am'], function () {
        Route::resource('projects', ProjectController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('tasks', TaskController::class);
    });
    Route::resource('users', UserController::class)->middleware('admin');
    Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->middleware('admin')->name('admin.dashboard');

    // Edit and update tasks by any authenticated user
    // Route::middleware(['can:update,task'])->group(function () {
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/{task}/report', [TaskController::class, 'showReportForm'])->name('tasks.report.form');
    Route::post('/tasks/{task}/report', [TaskController::class, 'submitReport'])->name('tasks.report.submit');
    // })l
});
