<?php

namespace App\Providers;

use App\Guards\TokenJWTGuard;
use App\Models\Campaign;
use App\Policies\CampaignPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Campaign::class => CampaignPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('token', function ($app, $name, array $config) {
            return new TokenJWTGuard(Auth::createUserProvider($config['provider']), request());
        });
    }
}
