<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Organization\Models\Organization;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        ResetPassword::createUrlUsing(function (Volunteer|Organization $user, string $token) {
            return config('app.client_app_url')."/auth/reset-password?token=$token&email=$user->email";
        });
    }
}
