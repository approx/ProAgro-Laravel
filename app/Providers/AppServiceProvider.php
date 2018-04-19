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
