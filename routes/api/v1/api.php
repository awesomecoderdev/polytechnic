<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\StudentController;
use App\Http\Controllers\Api\V1\Auth\TeacherController;
use App\Http\Controllers\Api\V1\FrontendController;
use App\Models\Collage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// V1 Base Route.
Route::any('/', [FrontendController::class, "index"])->name("index");

// Guest routes
Route::group(['prefix' => 'auth', "middleware" => "guest"], function () {

    // auth default route
    Route::any('/', [FrontendController::class, "auth"])->name("auth");

    // Student Routes
    Route::group(['prefix' => 'student', 'as' => 'student.', "controller" => StudentController::class], function () {
        // guest route
        Route::middleware(['student:false'])->group(function () {
            Route::post('/login', 'login')->name("login");
            Route::post('/register', 'register')->name("register");
        });

        // authorization route
        Route::middleware(['student'])->group(function () {
            Route::get('/', 'student')->name("student");
        });
    });

    // Teacher Routes
    Route::group(['prefix' => 'teacher', 'as' => 'teacher.', "controller" => TeacherController::class], function () {
        // guest route
        Route::middleware(['teacher:false'])->group(function () {
            Route::post('/login', 'login')->name("login");
            Route::post('/register', 'register')->name("register");
            Route::post('/update', 'update')->middleware("teacher")->name("update");
            Route::post('/delete', 'delete')->middleware("teacher")->name("delete");
        });

        // authorization route
        Route::middleware(['teacher'])->group(function () {
            // Route::get('/', 'teacher')->name("teacher");
        });
    });
});
