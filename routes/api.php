<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get("images", function (Request $request) {
//     return $request->json(["status => true"]);
// });

use App\Http\Controllers\ImageController;

Route::get("images", [ImageController::class, "index"]);
Route::get("images/get/{id}", [ImageController::class, "get"]);
Route::post("images/add", [ImageController::class, "add"]);
