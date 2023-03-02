<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CattleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cattles', [CattleController::class, "index"]);
Route::get('/cattles/{code}', [CattleController::class, "show"]);
Route::post('/cattles', [CattleController::class, "store"]);
Route::put('/cattles/{code}', [CattleController::class, "update"]);
Route::delete('cattles/{code}', [CattleController::class, "destroy"])->middleware(["slaughter.check"]);

Route::get('/cattles/report/milk', [CattleController::class, "milkProducedInTheWeek"]);
Route::get('/cattles/report/ration', [CattleController::class, "rationNeededPerWeek"]);
Route::get('/cattles/report/rationbyage', [CattleController::class, "checkRationByAge"]);
