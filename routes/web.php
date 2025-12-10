<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| LOGIN ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([\App\Http\Middleware\RoleCheck::class . ':student'])->group(function () {

    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/books', [StudentController::class, 'books'])->name('student.books');
    Route::post('/student/reserve/{id}', [StudentController::class, 'reserve'])->name('student.reserve');
    Route::get('/student/history', [StudentController::class, 'history'])->name('student.history');

});


/*
|--------------------------------------------------------------------------
| TEACHER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([\App\Http\Middleware\RoleCheck::class . ':teacher'])->group(function () {

    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::post('/teacher/borrow/{id}', [TeacherController::class, 'borrowBook'])->name('teacher.borrow');
    Route::post('/teacher/return/{id}', [TeacherController::class, 'returnBook'])->name('teacher.return');
    Route::post('/teacher/reserve/{id}', [TeacherController::class, 'reserveBook'])->name('teacher.reserve');
    Route::get('/teacher/history', [TeacherController::class, 'history'])->name('teacher.history');
    Route::get('/teacher/reservations', [TeacherController::class, 'reservations'])->name('teacher.reservations');

});


/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([\App\Http\Middleware\RoleCheck::class . ':staff'])->group(function () {

    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

    Route::get('/staff/reservations', [StaffController::class, 'viewReservations'])->name('staff.reservations');
    Route::post('/staff/reservation/approve/{id}', [StaffController::class, 'approveReservation'])->name('staff.reservation.approve');
    Route::post('/staff/reservation/reject/{id}', [StaffController::class, 'rejectReservation'])->name('staff.reservation.reject');
    Route::post('/staff/reservation/release/{id}', [StaffController::class, 'releaseBook'])->name('staff.reservation.release');

    Route::get('/staff/borrowings', [StaffController::class, 'processBorrowing'])->name('staff.borrowings');
    Route::post('/staff/return/{id}', [StaffController::class, 'staffReturn'])->name('staff.return');

    Route::get('/staff/clearance', [StaffController::class, 'clearance'])->name('staff.clearance');
    Route::get('/staff/clearance/{id}', [StaffController::class, 'checkClearance'])->name('staff.clearance.check');

    Route::get('/staff/teacher-clearance/{id}', [StaffController::class, 'checkTeacherClearance'])
        ->name('staff.teacher.clearance.check');

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([\App\Http\Middleware\RoleCheck::class . ':admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::post('/admin/users/update/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/admin/books', [AdminController::class, 'books'])->name('admin.books');
    Route::post('/admin/books/add', [AdminController::class, 'addBook'])->name('admin.books.add');
    Route::post('/admin/books/update/{id}', [AdminController::class, 'updateBook'])->name('admin.books.update');
    Route::post('/admin/books/delete/{id}', [AdminController::class, 'deleteBook'])->name('admin.books.delete');

});
