<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use App\Repositories\ProductRepository;
use App\Repositories\EloquentProduct;
use App\Repositories\CategoryRepository;
use App\Repositories\EloquentCategory;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepository::class, EloquentProduct::class);
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
    }
}
