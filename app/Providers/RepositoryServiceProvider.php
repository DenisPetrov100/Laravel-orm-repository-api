<?php

namespace App\Providers;

use App\Repository\Eloquent\EloquentRepositoryInterface;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\ProductRepositoryInterface;
use App\Repository\Eloquent\ShopRepository;
use App\Repository\Eloquent\ShopRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShopRepositoryInterface::class, ShopRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }
}
