<?php

namespace App\Providers;

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
