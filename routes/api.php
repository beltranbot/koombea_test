<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactFileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:api")->get("/user", function (Request $request) {
    return $request->user();
});
Route::resource("users", UserController::class)->only(["store", "index"]);
Route::middleware("auth:api")->group(function () {
    Route::prefix("contacts")->group(function () {
        Route::get("/", [ContactController::class, "index"]);
        Route::get("/{contact}", [ContactController::class, "show"]);
    });

    Route::prefix("files")->group(function () {
        Route::get("/", [ContactFileController::class, "index"]);
        Route::post("/", [ContactFileController::class, "store"]);
        Route::get("/{contact_file_id}/errors", [ContactFileController::class, "errors"]);
        Route::get("/{contact_file}", [ContactFileController::class, "show"]);
    });
});
