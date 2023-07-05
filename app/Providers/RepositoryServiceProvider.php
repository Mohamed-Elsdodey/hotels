<?php

namespace App\Providers;

use App\repository\DbCategoryRentRepository;
use App\repository\DbExpenseCategoryRepository;
use App\repository\DbExpenseRepository;
use App\repository\DbRentPlaceRepository;
use App\repositoryinterface\CategoryRentInterface;
use App\repositoryinterface\ExpenseCategoryInterface;
use App\repositoryinterface\ExpenseInterface;
use App\repositoryinterface\RentPlaceInterface;
use Illuminate\Support\ServiceProvider;

use App\repository\DbHotelRepository;
use App\repository\DbRoomFeatureRepository;
use App\repositoryinterface\HotelInterface;
use App\repositoryinterface\RoomFeatureInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HotelInterface::class,DbHotelRepository::class);
        $this->app->bind(RoomFeatureInterface::class,DbRoomFeatureRepository::class);
        $this->app->bind(CategoryRentInterface::class,DbCategoryRentRepository::class);
        $this->app->bind(RentPlaceInterface::class,DbRentPlaceRepository::class);
        $this->app->bind(ExpenseCategoryInterface::class,DbExpenseCategoryRepository::class);
        $this->app->bind(ExpenseInterface::class,DbExpenseRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
