<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\HotelPolicy;
use App\Policies\ProductPolicy;
use App\Policies\TypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        Gate::define('create-hotel', 'App\Policies\HotelPolicy@create');
        Gate::define('create-type', 'App\Policies\TypePolicy@create');
        Gate::define('create-product', 'App\Policies\ProductPolicy@create');
        Gate::define('create-typehotel', 'App\Policies\TypeHotelPolicy@create');
        Gate::define('create-typeproduct', 'App\Policies\TypeProductPolicy@create');


        Gate::define('delete-hotel', 'App\Policies\HotelPolicy@delete');
        Gate::define('delete-type', 'App\Policies\TypePolicy@delete');
        Gate::define('delete-product', 'App\Policies\ProductPolicy@delete');
        Gate::define('delete-transaction', 'App\Policies\TransactionPolicy@delete');
        Gate::define('delete-typehotel', 'App\Policies\TypeHotelPolicy@delete');
        Gate::define('delete-typeproduct', 'App\Policies\TypeProductPolicy@delete');



    }
}
