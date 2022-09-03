<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvuploadController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangFlagController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\API\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/auth/redirect/{driver}',[AuthController::class,'socialRedirect']);
Route::get('/auth/callback/{driver}',[AuthController::class,'socialCallback']);
//Route::get('translate-detail',[HomeController::class,'translate'])->name('translate-detail');

Route::middleware(['license'])->group(function (){
    Route::get('policy',[HomeController::class,'policy'])->name('policy');
});
Route::post('/contact',[ContactController::class,'contact'])->name('contact');
Route::get('search-translation',[HomeController::class,'searchDictionary'])->name('search-language');
Route::get('check-count',[HomeController::class,'checkCount'])->name('check-count');
Route::get('pages/{slug}',[HomeController::class,'slug'])->name('slug');

require __DIR__.'/auth.php';




