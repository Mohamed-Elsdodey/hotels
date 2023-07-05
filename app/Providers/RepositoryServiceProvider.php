<?php

namespace App\Providers;

use App\repository\DbBookingRepository;
use App\repository\DbCategoryRentRepository;
use App\repository\DbCustomerRepository;
use App\repository\DbExpenseCategoryRepository;
use App\repository\DbExpenseRepository;
use App\repository\DbGovernorateRepository;
use App\repository\DbRentPlaceRepository;
use App\repositoryinterface\BookingInterface;
use App\repositoryinterface\CategoryRentInterface;
use App\repositoryinterface\CustomerInterface;
use App\repositoryinterface\ExpenseCategoryInterface;
use App\repositoryinterface\ExpenseInterface;
use App\repositoryinterface\GovernorateInterface;
use App\repositoryinterface\RentPlaceInterface;
use GuzzleHttp\ClientInterface;
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
        $this->app->bind(GovernorateInterface::class,DbGovernorateRepository::class);
        $this->app->bind(CustomerInterface::class,DbCustomerRepository::class);
        $this->app->bind(BookingInterface::class,DbBookingRepository::class);

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
