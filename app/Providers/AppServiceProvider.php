<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\AddressRepositoryInterface',
            'App\Repositories\AddressRepository'
        );

        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\BrandRepositoryInterface',
            'App\Repositories\BrandRepository'
        );

        $this->app->bind(
            'App\Repositories\CartProductRepositoryInterface',
            'App\Repositories\CartProductRepository'
        );

        $this->app->bind(
            'App\Repositories\CartRepositoryInterface',
            'App\Repositories\CartRepository'
        );

        $this->app->bind(
            'App\Repositories\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\OrderRepositoryInterface',
            'App\Repositories\OrderRepository'
        );

        $this->app->bind(
            'App\Repositories\OrderProductRepositoryInterface',
            'App\Repositories\OrderProductRepository'
        );

        $this->app->bind(
            'App\Repositories\PayemntRepositoryInterface',
            'App\Repositories\PayemntRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\ProductRepository'
        );

        $this->app->bind(
            'App\Repositories\ProfileRepositoryInterface',
            'App\Repositories\ProfileRepository'
        );

        $this->app->bind(
            'App\Repositories\PromotionRepositoryInterface',
            'App\Repositories\PromotionRepository'
        );

        $this->app->bind(
            'App\Repositories\ShippingMethodRepositoryInterface',
            'App\Repositories\ShippingMethodRepository'
        );

        $this->app->bind(
            'App\Repositories\SubCategoryRepositoryInterface',
            'App\Repositories\SubCategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\WishListRepositoryInterface',
            'App\Repositories\WishListRepository'
        );

        $this->app->bind(
            'App\Repositories\WishListProductRepositoryInterface',
            'App\Repositories\WishListProductRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductImageRepositoryInterface',
            'App\Repositories\ProductImageRepository'
        );        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
