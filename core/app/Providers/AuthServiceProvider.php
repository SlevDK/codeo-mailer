<?php

namespace App\Providers;

use App\Guards\TokenJWTGuard;
use App\Models\Body;
use App\Models\Campaign;
use App\Models\Mail;
use App\Models\Topic;
use App\Policies\BodyPolicy;
use App\Policies\CampaignPolicy;
use App\Policies\MailPolicy;
use App\Policies\TopicPolicy;
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
        Campaign::class => CampaignPolicy::class,
        Mail::class     => MailPolicy::class,
        Topic::class    => TopicPolicy::class,
        Body::class     => BodyPolicy::class,
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
