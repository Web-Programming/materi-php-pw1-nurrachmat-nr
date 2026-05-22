<?php

namespace App\Providers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gate untuk mengecek apakah user adalah admin
        Gate::define('manage-barang', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk update barang (bisa admin atau sales)
        Gate::define('update-barang', function (User $user, Barang $barang) {
            return $user->role === 'admin' || $user->role === 'sales' ;
        });

        // Gate untuk delete barang (hanya admin)
        Gate::define('delete-barang', function (User $user, Barang $barang) {
            return $user->role === 'admin';
        });

        // Gate untuk create barang (user yang sudah login)
        Gate::define('create-barang', function (User $user) {
            return $user !== null;
        });
    }
}
