<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\CustomerInterface;
use App\Interfaces\ServiceInterface;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\EnquiryInterface;
use App\Interfaces\InvoiceInterface;


use App\Repositories\CategoryRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\EnquiryRepository;
use App\Repositories\InvoiceRepository;



use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(ServiceInterface::class, ServiceRepository::class);
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);
        $this->app->bind(EnquiryInterface::class, EnquiryRepository::class);
        $this->app->bind(InvoiceInterface::class, InvoiceRepository::class);
        
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
