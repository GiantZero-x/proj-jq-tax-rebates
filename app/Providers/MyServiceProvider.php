<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25
 * Time: 11:24
 */

namespace App\Providers;

use App\Repositories\{
    CustomerRepositoryInterface,
    DataRepositoryInterface
};
use App\Repositories\Impl\{
    CustomerRepositoryImpl,
    DataRepositoryImpl
};

use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepositoryImpl::class);
        $this->app->bind(DataRepositoryInterface::class, DataRepositoryImpl::class);
    }
}