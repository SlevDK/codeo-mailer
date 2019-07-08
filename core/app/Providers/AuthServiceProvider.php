<?php

namespace App\Providers;

use App\Guards\TokenJWTGuard;
use App\Models\Body;
use App\Models\Campaign;
use App\Models\FromAlias;
use App\Models\FromDomain;
use App\Models\FromLogin;
use App\Models\Mail;
use App\Models\Maillist;
use App\Models\MailSettings;
use App\Models\ToAlias;
use App\Models\Topic;
use App\Policies\BodyPolicy;
use App\Policies\CampaignPolicy;
use App\Policies\FromAliasPolicy;
use App\Policies\FromDomainPolicy;
use App\Policies\FromLoginPolicy;
use App\Policies\MaillistPolicy;
use App\Policies\MailPolicy;
use App\Policies\MailSettingsPolicy;
use App\Policies\ToAliasPolicy;
use App\Policies\TopicPolicy;
use App\Models\Database\Topic as DatabaseTopic;
use App\Policies\Database\TopicPolicy as DatabaseTopicPolicy;
use App\Models\Database\Maillist as DatabaseMaillist;
use App\Policies\Database\MaillistPolicy as DatabaseMaillistPolicy;
use App\Models\Database\Proxy as DatabaseProxy;
use App\Policies\Database\ProxyPolicy as DatabaseProxyPolicy;
Use App\Models\Database\Header as DatabaseHeader;
use App\Policies\Database\HeaderPolicy as DatabaseHeaderPolicy;
use App\Models\Database\FromDomain as DatabaseFromDomain;
use App\Policies\Database\FromDomainPolicy as DatabaseFromDomainPolicy;
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
        // campaign
        Campaign::class => CampaignPolicy::class,
        FromLogin::class    => FromLoginPolicy::class,
        FromDomain::class   => FromDomainPolicy::class,
        Maillist::class     => MaillistPolicy::class,

        // mail
        Mail::class     => MailPolicy::class,
        Topic::class    => TopicPolicy::class,
        Body::class     => BodyPolicy::class,
        ToAlias::class  => ToAliasPolicy::class,
        FromAlias::class    => FromAliasPolicy::class,
        MailSettings::class => MailSettingsPolicy::class,

        // database
        DatabaseTopic::class    => DatabaseTopicPolicy::class,
        DatabaseMaillist::class => DatabaseMaillistPolicy::class,
        DatabaseProxy::class    => DatabaseProxyPolicy::class,
        DatabaseHeader::class   => DatabaseHeaderPolicy::class,
        DatabaseFromDomain::class   => DatabaseFromDomainPolicy::class

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
