<?php

use App\Http\Controllers\AppLinkController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Question;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvuploadController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LangFlagController;
use App\Http\Controllers\LicenseController;






/*
 * Start Admin Login routes
 */

Route::get('/login',[AdminController::class,'login_page'])->name('admin.login');
Route::post('/login',[AdminController::class,'admin_login'])->name('admin.login');

/*
 * End Admin login routes
 */

/*
 * Start Admin routes
 */
Route::middleware(['admin'])->group(function(){
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('admin.dashboard');
    Route::get('change-password',[AuthController::class,'change_password'])->name('auth.change-password');
    Route::post('change-password/store',[AuthController::class,'changePasswordStore'])->name('auth.change-password.store');

    Route::get('edit-profile',[AuthController::class,'editProfile'])->name('auth.profile');
    Route::post('edit-profile/store',[AuthController::class,'editProfileStore'])->name('auth.profile.store');

    /*
     * Start upload routes
     */

    Route::get('upload-csv',[CsvuploadController::class,'index'])->name('csv.index');
    Route::match(array('GET', 'POST'), "all-upload-csv/{csv_id}", [CsvuploadController::class,'allUploadCsv'])->name('csv.allUploadCsv');
    Route::get('upload-csv/create',[CsvuploadController::class,'create'])->name('csv.create');
    Route::post('upload-csv/store',[CsvuploadController::class,'store'])->name('csv.store');

    /*
     * End upload routes
     */

    /*
     *  Start languages routes
     */

    Route::get('languages',[LanguageController::class,'index'])->name('languages.index');
    Route::get('languages/create',[LanguageController::class,'create'])->name('languages.create');
    Route::post('languages/store',[LanguageController::class,'store'])->name('languages.store');
    Route::post('languages',[LanguageController::class,'index'])->name('languages.index');

    /*
     *  End languages routes
     */

    /*
     *  Start licenses routes
     */

    Route::get('licenses',[LicenseController::class,'index'])->name('licenses.index');
    Route::get('licenses/create',[LicenseController::class,'create'])->name('licenses.create');
    Route::post('licenses/store',[LicenseController::class,'store'])->name('licenses.store');
    Route::get('licenses/edit/{id}',[LicenseController::class,'edit'])->name('licenses.edit');
    Route::post('licenses/update/{id}',[LicenseController::class,'update'])->name('licenses.update');
    Route::delete('licenses/delete/{id}',[LicenseController::class,'destroy'])->name('licenses.delete');
    Route::get('licenses/change/{id}',[LicenseController::class,'change'])->name('licenses.change');

    /*
     *  End licenses routes
     */

    /*
     *  Start languages-flag routes
     */

    Route::get('language-flags',[LangFlagController::class,'index'])->name('flags.index');
    Route::get('language-flags/{id}/edit',[LangFlagController::class,'edit'])->name('flags.edit');
    Route::post('language-flags/{id}/update',[LangFlagController::class,'update'])->name('flags.update');
    Route::get('language-flags/create',[LangFlagController::class,'create'])->name('flags.create');
    Route::post('language-flags/store',[LangFlagController::class,'store'])->name('flags.store');

    /*
     *  End languages-flag routes
     */

    /*
     * App Link Routes
     * */

    Route::get('app_links',[AppLinkController::class,'index'])->name('app_links.index');
    Route::get('app_links/create',[AppLinkController::class,'create'])->name('app_links.create');
    Route::post('app_links/store',[AppLinkController::class,'store'])->name('app_links.store');
    Route::get('app_links/edit/{id}',[AppLinkController::class,'edit'])->name('app_links.edit');
    Route::post('app_links/update/{id}',[AppLinkController::class,'update'])->name('app_links.update');
    Route::delete('app_links/delete/{id}',[AppLinkController::class,'destroy'])->name('app_links.delete');



    /*
     * End App Link routes
     */

    /*
     * Slider Routes
     */

    Route::get('sliders',[SliderController::class,'index'])->name('sliders.index');
    Route::get('sliders/create',[SliderController::class,'create'])->name('sliders.create');
    Route::post('sliders/store',[SliderController::class,'store'])->name('sliders.store');
    Route::get('sliders/edit/{id}',[SliderController::class,'edit'])->name('sliders.edit');
    Route::post('sliders/update/{id}',[SliderController::class,'update'])->name('sliders.update');
    Route::delete('sliders/delete/{id}',[SliderController::class,'destroy'])->name('sliders.delete');



    /*
     * End slider routes
     */

    /*
     * Questions Routes
     */

    Route::get('question',[QuestionController::class,'index'])->name('question.index');
    Route::get('question/create',[QuestionController::class,'create'])->name('question.create');
    Route::post('question/store',[QuestionController::class,'store'])->name('question.store');
    Route::get('question/edit/{id}',[QuestionController::class,'edit'])->name('question.edit');
    Route::post('question/update/{id}',[QuestionController::class,'update'])->name('question.update');
    Route::delete('question/delete/{id}',[QuestionController::class,'destroy'])->name('question.delete');



    /*
     * End Questions routes
     */

    /*
     * Product routes
     */

    Route::get('product',[ProductController::class,'index'])->name('products.index');
    Route::get('product/create',[ProductController::class,'create'])->name('products.create');
    Route::post('product/store',[ProductController::class,'store'])->name('products.store');
    Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
    Route::post('product/update/{id}',[ProductController::class,'update'])->name('products.update');
    Route::delete('product/delete/{id}',[ProductController::class,'destroy'])->name('products.delete');


    /*
     * End Product routes
     */
    /*
     * Plan routes
     */

    Route::get('plans',[PlanController::class,'index'])->name('plans.index');
    Route::get('plans/create',[PlanController::class,'create'])->name('plans.create');
    Route::post('plans/store',[PlanController::class,'store'])->name('plans.store');
    Route::get('plans/edit/{id}',[PlanController::class,'edit'])->name('plans.edit');
    Route::post('plans/update/{id}',[PlanController::class,'update'])->name('plans.update');
    Route::delete('plans/delete/{id}',[PlanController::class,'destroy'])->name('plans.delete');
    Route::get('plans/change/{id}',[PlanController::class,'change'])->name('plans.change');


    /*
     * End Plan routes
     */
    /*
     * Navigation routes
     */

    Route::get('navigation',[NavigationController::class,'index'])->name('navigation.index');
    Route::get('navigation/create',[NavigationController::class,'create'])->name('navigation.create');
    Route::post('navigation/store',[NavigationController::class,'store'])->name('navigation.store');
    Route::get('navigation/edit/{id}',[NavigationController::class,'edit'])->name('navigation.edit');
    Route::post('navigation/update/{id}',[NavigationController::class,'update'])->name('navigation.update');
    Route::delete('navigation/delete/{id}',[NavigationController::class,'destroy'])->name('navigation.delete');
    Route::get('navigation/change/{id}',[NavigationController::class,'change'])->name('navigation.change');



    /*
     * End Navigation routes
     */
    /*
     * Page routes
     */

    Route::get('pages',[PageController::class,'index'])->name('pages.index');
    Route::get('pages/create',[PageController::class,'create'])->name('pages.create');
    Route::post('pages/store',[PageController::class,'store'])->name('pages.store');
    Route::post('pages/upload',[PageController::class,'upload'])->name('ckeditor.upload');
    Route::get('pages/edit/{id}',[PageController::class,'edit'])->name('pages.edit');
    Route::post('pages/update/{id}',[PageController::class,'update'])->name('pages.update');
    Route::delete('pages/delete/{id}',[PageController::class,'destroy'])->name('pages.delete');

    /*
     * End Page routes
     */

    Route::get('settings/create',[SettingController::class,'create'])->name('settings.create');
    Route::post('settings/update',[SettingController::class,'update'])->name('settings.update');
    /*
     * End Admin routes
     */
});

