<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Crop;
use App\Observers\CropObserver;
use App\Activity;
use App\Observers\ActivityObserver;
use App\IncomeHistory;
use App\Observers\IncomeObserver;
use App\Field;
use App\Observers\FieldObserver;
use App\Farm;
use App\Observers\FarmObserver;
use App\SackSold;
use App\Observers\SackSoldObserver;
use App\Stock;
use App\Observers\StockObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Activity::observe(ActivityObserver::class);
        Crop::observe(CropObserver::class);
        IncomeHistory::observe(IncomeObserver::class);
        Field::observe(FieldObserver::class);
        Farm::observe(FarmObserver::class);
        SackSold::observe(SackSoldObserver::class);
        Stock::observe(StockObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
