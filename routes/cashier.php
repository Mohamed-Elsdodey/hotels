<?php

use App\Http\Controllers\Chef\OrderController;
use App\Http\Controllers\Cashier\{AuthController,
    HomeController,

};
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/cashier',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Route::get('login', [AuthController::class, 'loginView'])->name('cashier.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('cashier.postLogin');

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/cashier',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'cashier']
    ], function() {


    Route::group([ 'middleware' => 'cashier', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('cashier.index');
        Route::get('calender', [HomeController::class, 'calender'])->name('cashier.calender');

        Route::get('logout', [AuthController::class, 'logout'])->name('cashier.logout');


        Route::get('cashier/showProfile', [AuthController::class, 'showProfile'])->name('cashier.showProfile');
        Route::put('chef/updateProfile/{id}', [AuthController::class, 'updateProfile'])->name('cashier.updateProfile');
        Route::post('cashier/order/create', [OrderController::class, 'store'])->name('cashier.order.store');
    });

});
