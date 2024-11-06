<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/managae_users', [UserController::class, 'allUser']
)->middleware(['auth', 'verified', 'role:admin'])->name('managae_user');
Route::get('/manage-courses', [CoursesController::class,'index']
)->middleware(['auth', 'verified', 'role:admin'])->name('manage-courses');


Route::get('admin', function () {
    return view('admins/dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin');


Route::get('mentor', function () {
    return view('mentor/dashboard');
})->middleware(['auth', 'verified', 'role:mentor'])->name('mentor');

Route::get('student', function () {
    return view('students/dashboard');
})->middleware(['auth', 'verified', 'role:student'])->name('student');

Route::post('add-mentor', [UserController::class, 'addMentor'])->name('add-mentor');
Route::post('add-student', [UserController::class, 'addStudent'])->name('add-student');
Route::get('/manage_user/{id}/edit', [UserController::class, 'singleUser'])->name('edit');
Route::put('/manage_user/{id}', [UserController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [UserController::class,'destroy'])->name('delete');


Route::get('/manage-courses/{id}/edit', [CoursesController::class, 'singleCourse'])->name('edit');
Route::put('/manage-courses/{id}', [CoursesController::class, 'update'])->name('courses-update');
Route::post('add-courses', [CoursesController::class, 'addCourse'])->name('add-courses');

require __DIR__.'/auth.php';
