<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator; //untuk Handle CSS ketika memanggil fungsi pagination laravel memberikan style bootstrap
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        //Paginator::useBootstrap();

        //Membuat Gate khusus is_admin khusus admin bagas
        Gate::define('is_admin', function(User $user){
            return $user->is_admin;
        });
    }
}
