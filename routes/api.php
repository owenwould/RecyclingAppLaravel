<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecycleItemsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/items', [RecycleItemsController::class,'index']);
Route::get('/totalItems', [RecycleItemsController::class,'getTotalRecycled']);
Route::prefix('/item')->group( function () {
 Route::post('/add',[RecycleItemsController::class,'add']);
// Route::put('/{id}', [RecycleItemsController::class,'']);

});