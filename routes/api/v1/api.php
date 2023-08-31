<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\StudentController;
use App\Http\Controllers\Api\V1\Auth\TeacherController;
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
Route::any('/', function (Request $request) {

    // foreach (range('a', 'z') as $key => $search) {
    //     $response = Http::get("https://btebresultszone.com/api/institutes/search?search=$search");
    //     $collages = $response->json();

    //     $data = collect($collages)->map(function ($item, $key) {
    //         $collage = [
    //             "name" => str_replace([", ,", "  "], [",", " "], $item["name"]),
    //             "eiin" => $item["code"],
    //             "district" => $item["district"],
    //         ];
    //         return $collage;
    //     })->toArray();



    //     foreach ($data as $key => $value) {
    //         try {
    //             $collage = new Collage();
    //             $collage->name = $value["name"];
    //             $collage->eiin = $value["eiin"];
    //             $collage->district = $value["district"];
    //             $collage->save();
    //         } catch (\Throwable $th) {
    //             // throw $th;
    //         }
    //     }
    // }

    return response()->json([
        "success" => true,
        "status" => 200,
        "message" => "Polytechnic API Version V0.1",
        "data" => [
            // "collages" => $data
            "collage" => $request->collage
        ]
    ]);
});


// Guest routes
Route::group(['prefix' => 'auth', "middleware" => "guest"], function () {

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
