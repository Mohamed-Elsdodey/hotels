<?php

use App\Http\Controllers\Admin\{AuthController,
    HomeController,

};
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {


    Route::get('login', [AuthController::class, 'loginView'])->name('admin.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('admin.postLogin');

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'admin']
    ], function() {


    Route::group([ 'middleware' => 'admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('admin.index');
        Route::get('calender', [HomeController::class, 'calender'])->name('admin.calender');

        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        ### admins

        Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
        Route::get('activateAdmin', [App\Http\Controllers\Admin\AdminController::class, 'activate'])->name('admin.active.admin');



        ### setting
        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);



    });

});