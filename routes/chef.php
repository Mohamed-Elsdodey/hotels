<?php

use App\Http\Controllers\Chef\{AuthController,
    HomeController,

};
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/chef',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {


    Route::get('login', [AuthController::class, 'loginView'])->name('chef.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('chef.postLogin');

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/chef',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'chef']
    ], function() {


    Route::group([ 'middleware' => 'chef', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('chef.index');
        Route::get('calender', [HomeController::class, 'calender'])->name('chef.calender');

        Route::get('logout', [AuthController::class, 'logout'])->name('chef.logout');

        Route::get('chef/showProfile', [AuthController::class, 'showProfile'])->name('chef.showProfile');
        Route::put('chef/updateProfile/{id}', [AuthController::class, 'updateProfile'])->name('chef.updateProfile');

        Route::resource('notifications', \App\Http\Controllers\Chef\NotificationsController::class);


        Route::resource('show_orders', \App\Http\Controllers\Chef\ShowOrdersController::class);


    });

});
