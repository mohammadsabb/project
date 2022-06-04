<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;

Route::group(
    ['prefix => course_store'],
    function () {
        Route::get('/', [PagesController::class, 'index'])->name('website.index');
        Route::post('/search', [PagesController::class, 'search'])->name('website.search');
        Route::get('/course/{slug}', [PagesController::class, 'course'])->name('website.course');
        Route::get('/register/{slug}', [PagesController::class, 'register'])->name('website.register');
        Route::post('/register/{slug}', [PagesController::class, 'SubmitRegister'])->name('website.register');
        Route::get('/pay/{id}', [PagesController::class, 'pay'])->name('website.pay');
        Route::get('/thanks/{id}', [PagesController::class, 'thanks'])->name('website.thanks');
        Route::get('/contact', [PagesController::class, 'contact'])->name('website.contact');
    }
);

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('dashboard.index');
    Route::resource('categories', CategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/all-registrations', [CourseController::class, 'registrations'])->name('registrations');
    Route::delete('/all-registrations/delete/{id}', [CourseController::class, 'registrationsDelete'])->name('registrations.destroy');
});

// Route::get('/', function () {
//     return bcrypt('123456789'); // دالة التشفير في اللارافيل
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
