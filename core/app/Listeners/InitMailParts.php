<?php

namespace App\Listeners;

use App\Models\Body;
use App\Models\FromAlias;
use App\Models\FromDomain;
use App\Models\FromLogin;
use App\Models\Header;
use App\Models\MailSettings;
use App\Models\ToAlias;
use App\Models\Topic;

class InitMailParts
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $mail = $event->mail;

        // create Mail parts -> Header, Body, Topic, etc
        Header::initHeader($mail);
        Topic::initTopic($mail);
        Body::initBody($mail);
        MailSettings::initSettings($mail);
        FromAlias::initToAlias($mail);
        ToAlias::initToAlias($mail);
        FromLogin::initFromLogin($mail);
        FromDomain::initFromDomain($mail);
    }
}
