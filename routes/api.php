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
Route::get('/cattles/{id}', [CattleController::class, "show"]);
Route::post('/cattles', [CattleController::class, "store"]);
Route::put('/cattles/{id}', [CattleController::class, "update"]);
Route::delete('cattles/{id}', [CattleController::class, "destroy"]);

Route::patch('cattles/slaughter/{id}', [CattleController::class, "slaughter"]);

Route::get('/cattles/report/milk', [CattleController::class, "milkProducedInTheWeek"]);
Route::get('/cattles/report/ration', [CattleController::class, "rationNeededPerWeek"]);
Route::get('/cattles/report/ration_by_age', [CattleController::class, "checkRationByAge"]);
