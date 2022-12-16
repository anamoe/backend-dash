<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransaksiController;
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

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::get('transaksi/{id}',[TransaksiController::class,'index']);
Route::get('transaksi-show/{id}',[TransaksiController::class,'show']);
Route::post('create-transaksi',[TransaksiController::class,'create']);
Route::post('transaksi-update/{id}',[TransaksiController::class,'update']);
