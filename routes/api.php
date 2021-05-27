<?php

use App\Http\Controllers\ContactController;
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
Route::middleware("auth:api")->prefix("contacts")->group(function () {
    Route::get("/", [ContactController::class, "index"]);
    Route::post("upload", [ContactController::class, "upload"]);
    Route::prefix("files")->group(function () {
        Route::get("/", [ContactController::class, "files"]);
        Route::get("/{contact_file_id}/errors", [ContactController::class, "errors"]);
    });
    Route::get("/{contact_file}", [ContactController::class, "show"]);
});
