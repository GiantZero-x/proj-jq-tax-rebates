<?php

namespace App\Providers;

use App\Model;
use App\Observers\ModelObserver;
use Curl\Curl;
use Illuminate\Support\ServiceProvider;

use App\Repositories\{
    ClearanceRepositoryInterface, CustomerRepositoryInterface, DataRepositoryInterface, DrawerRepositoryInterface, InvoiceRepositoryInterface, OrderRepositoryInterface, ProductRepositoryInterface, RemitteeRepositoryInterface, TransportRepositoryInterface, UserRepositoryInterface
};
use App\Repositories\Impl\{
    ClearanceRepositoryImpl, CustomerRepositoryImpl, DataRepositoryImpl, DrawerRepositoryImpl, InvoiceRepositoryImpl, ProductRepositoryImpl, OrderRepositoryImpl, RemitteeRepositoryImpl, TransportRepositoryImpl, UserRepositoryImpl
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepositoryImpl::class);
        $this->app->bind(ClearanceRepositoryInterface::class, ClearanceRepositoryImpl::class);
        $this->app->bind(DataRepositoryInterface::class, DataRepositoryImpl::class);
        $this->app->bind(DrawerRepositoryInterface::class, DrawerRepositoryImpl::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepositoryImpl::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepositoryImpl::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepositoryImpl::class);
        $this->app->bind(TransportRepositoryInterface::class, TransportRepositoryImpl::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepositoryImpl::class);
        $this->app->bind(RemitteeRepositoryInterface::class, RemitteeRepositoryImpl::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryImpl::class);
        /*$this->app->singleton(Curl::class, function () {
            return new Curl();
        });*/
    }
}
