<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard\Admin\AdminDashboardController;
use App\Http\Controllers\Dashboard\Admin\CommitteeMemberController;
use App\Http\Controllers\Dashboard\Admin\EthicsCommitteeMemberController;
use App\Http\Controllers\Dashboard\Admin\ExecutiveOfficeMemberController;
use App\Http\Controllers\Dashboard\Student\NotificationController;
use App\Http\Controllers\Dashboard\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Dashboard\Student\ProjectsController;
use App\Http\Controllers\Dashboard\Student\StudentControlle;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\UserManagementController;

use App\Http\Controllers\Dashboard\Admin\StudentManagementController as AdminStudentManagementController;
use App\Http\Controllers\Dashboard\Admin\StudentManagementController;
use App\Http\Controllers\Dashboard\Admin\StudentManagementController as DashboardAdminStudentManagementController;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

//student dashboard
Route::middleware(['auth', 'verified'])->prefix('/student')->name('student.dashboard.')->group(function () {
    Route::get('/dashboard', [StudentControlle::class, 'index'])->name('home');
    Route::resource('/profile', StudentProfileController::class);
    Route::resource('/projects', ProjectsController::class);

    //Notifications system
    Route::get('/notifications', [NotificationController::class, 'index'])

        ->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'read'])
        ->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.readAll');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.dashboard.')
    ->group(function () {
        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('home');

        Route::get(
            '/dashboard/export',
            [AdminDashboardController::class, 'exportReport']
        )->name('export');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.users.')
    ->controller(UserManagementController::class)
    ->group(function () {
        Route::get('/users', 'index')->name('index');

        Route::patch(
            '/users/{user}/toggle-block',
            'toggleBlock'
        )->name('toggle-block');
    });
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.students.')
    ->controller(DashboardAdminStudentManagementController::class)
    ->group(function () {
        Route::get('/students', 'index')->name('index');




        Route::post('/students', 'store')->name('store');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.executive-members.')
    ->controller(ExecutiveOfficeMemberController::class)
    ->group(function () {
        Route::get('/executive-members', 'index')->name('index');

        Route::post('/executive-members', 'store')->name('store');

        Route::put(
            '/executive-members/{user}',
            'update'
        )->name('update');

        Route::patch(
            '/executive-members/{user}/toggle-status',
            'toggleStatus'
        )->name('toggle-status');
    });
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.committee-members.')
    ->controller(CommitteeMemberController::class)
    ->group(function () {

        Route::get(
            '/committee-members',
            'index'
        )->name('index');

        Route::post(
            '/committee-members',
            'store'
        )->name('store');

        Route::put(
            '/committee-members/{user}',
            'update'
        )->name('update');

        Route::patch(
            '/committee-members/{user}/toggle-status',
            'toggleStatus'
        )->name('toggle-status');
    });




Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.ethics-committee-members.')
    ->controller(EthicsCommitteeMemberController::class)
    ->group(function () {
        Route::get(
            '/ethics-committee-members',
            'index'
        )->name('index');

        Route::post(
            '/ethics-committee-members',
            'store'
        )->name('store');

        Route::put(
            '/ethics-committee-members/{user}',
            'update'
        )->name('update');

        Route::patch(
            '/ethics-committee-members/{user}/toggle-status',
            'toggleStatus'
        )->name('toggle-status');
    });









Route::middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
