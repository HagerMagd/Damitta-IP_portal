<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard\Student\NotificationController;
use App\Http\Controllers\Dashboard\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Dashboard\Student\ProjectsController;
use App\Http\Controllers\Dashboard\Student\StudentControlle;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

//student dashboard
Route::middleware('auth','verified')->prefix('/student')->name('student.dashboard.')->group(function(){
Route::get('/dashboard',[StudentControlle::class,'index'])->name('home');
Route::resource('/profile',StudentProfileController::class);
Route::resource('/projects',ProjectsController::class);

//Notifications system
Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'read'])
    ->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
    ->name('notifications.readAll');

});

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
