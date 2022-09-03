<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
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

Route::get('languages',[ApiController::class,'getLanguages']);
Route::get('languages/json',[ApiController::class,'getLanguagesJson']);
Route::get('languages/dictionary',[ApiController::class,'searchDictionary'])->middleware('custom_auth');
Route::get('languages/dictionary/{ids}',[ApiController::class,'searchDictionaryIds'])->middleware('custom_auth');
Route::get('languages/all',[ApiController::class,'getAllLanguages'])->middleware('custom_auth');
Route::get('languages/mobile',[ApiController::class,'getAllLanguages']);
Route::post('check-license',[ApiController::class,'checkLicenses']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
