<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('home');
})->name('home');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/admin/add-teacher', [AdminController::class, 'addTeacher'])->name('add.teacher');
Route::post('/admin/delete-teacher/{user:username}', [AdminController::class , 'deleteTeacher'])->name('delete.teacher');
Route::post('/admin/update-teacher/{user:username}', [AdminController::class, 'updateTeacher'])->name('update.teacher');
Route::post('/admin/add-role', [AdminController::class, 'addRole'])->name('add.role');
Route::post('/admin/delete-role/{role:name}', [AdminController::class, 'deleteRole'])->name('delete.role');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/student', [StudentController::class, 'index'])->name('student.dashboard');
Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.dashboard');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
