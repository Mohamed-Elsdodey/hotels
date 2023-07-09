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

        Route::get('activateAdmin', [App\Http\Controllers\Admin\AdminController::class, 'activate'])->name('admin.active.admin');

        Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);


        ### setting
        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);


        ### category_rents
        Route::resource('category_rents', \App\Http\Controllers\Admin\CategoryRents\CategoryRent::class);


        ### rent_places
        Route::resource('rent_places', \App\Http\Controllers\Admin\RentPlaces\RentPlace::class);


        ### rent_places
        Route::resource('expense_categories', \App\Http\Controllers\Admin\ExpenseCategories\ExpenseCategory::class);


        ### expenses
        Route::resource('expenses', \App\Http\Controllers\Admin\Expenses\Expense::class);
        Route::get('getSubExpenseCategoryByMain/{id}', [\App\Http\Controllers\Admin\Expenses\Expense::class,'getSubExpenseCategoryByMain'])->name('admin.getSubExpenseCategoryByMain');


        ###  governorates
        Route::resource('governorates', \App\Http\Controllers\Admin\Governorates\Governorate::class);


        ###  clients
        Route::resource('clients', \App\Http\Controllers\Admin\Clients\Client::class);


        ### booking
        Route::resource('booking', \App\Http\Controllers\Admin\Booking\Booking::class);
        Route::get('getRoomsInBooking',[\App\Http\Controllers\Admin\Booking\Booking::class,'getRoomsInBooking'])->name('admin.getRoomsInBooking');
        Route::get('getRoomPrice/{id}',[\App\Http\Controllers\Admin\Booking\Booking::class,'getRoomPrice'])->name('admin.getRoomPrice');
        Route::get('store_booking',[\App\Http\Controllers\Admin\Booking\Booking::class,'store_booking'])->name('admin.store_booking');


        ### hotels
        Route::resource('hotels', \App\Http\Controllers\Admin\Hotels\Hotels::class);//hotels
        Route::resource('roomsfeatures', \App\Http\Controllers\Admin\RoomFeatures\RoomFeature::class);//roomsfeatures
        ### categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);//categoriesphp

        ### settings

        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);//hotels

        Route::resource('roomcategory', \App\Http\Controllers\Admin\RoomCategories\RoomCategory::class);//roomcategory

        Route::resource('rooms', \App\Http\Controllers\Admin\Rooms\Rooms::class);//roomcategory


        Route::resource('invocing', \App\Http\Controllers\Admin\invocing\Invocing::class);//invocing

        Route::get('invocing',[\App\Http\Controllers\Admin\invocing\Invocing::class,'invoice'])->name('invocing');
        Route::get('openBat',[\App\Http\Controllers\Admin\invocing\Invocing::class,'openBat'])->name('openBat');

    });

});
