<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        Gate::define('admin', function () {
            $email = Auth::user()->email;
            $user = User::whereEmail($email)->firstOrFail();
            return $user->hasRole('admin');
        });
        Gate::define('bidang keuangan', function () {
            $email = Auth::user()->email;
            $user = User::whereEmail($email)->firstOrFail();
            return $user->hasRole('bidang keuangan');
        });
        Gate::define('bidang kesyabandaran', function () {
            $email = Auth::user()->email;
            $user = User::whereEmail($email)->firstOrFail();
            return $user->hasRole('bidang kesyabandaran');
        });
        Gate::define('bidang pengelola bmn dan persediaan', function () {
            $email = Auth::user()->email;
            $user = User::whereEmail($email)->firstOrFail();
            return $user->hasRole('bidang pengelola bmn dan persediaan');
        });
        Gate::define('bidang kepegawaian atau tata usaha', function () {
            $email = Auth::user()->email;
            $user = User::whereEmail($email)->firstOrFail();
            return $user->hasRole('bidang kepegawaian atau tata usaha');
        });
        Gate::define('bidang kepelabuhan', function () {
            $email = Auth::user()->email;
            $user = User::whereEmail($email)->firstOrFail();
            return $user->hasRole('bidang kepelabuhan');
        });
    }
}
