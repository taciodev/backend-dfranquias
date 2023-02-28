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

Route::post('/cattles/create', [CattleController::class, "create"]);
Route::get('/cattles/search', [CattleController::class, "searchAll"]);
Route::get('/cattles/{code}', [CattleController::class, "search"]);
Route::put('/cattles/{code}', [CattleController::class, "update"]);
Route::delete('cattles/down/{code}', [CattleController::class, "shootDown"]);



// TODO: CREATE. ✅
// TODO: Pode haver apenas um animal vivo com o mesmo código. ✅
// TODO: UUID e CREATED_AT funcionando.

// TODO: READ. ✅
// TODO: Não pode buscar um UUID que não existe. ✅
// TODO: Retornar outro status caso o uuid não exista.

// TODO: DELETE. ✅
// TODO: Não pode ser deletado um gado não existe. ✅

