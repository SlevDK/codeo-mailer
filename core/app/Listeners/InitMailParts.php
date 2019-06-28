<?php

namespace App\Listeners;

use App\Models\Body;
use App\Models\Header;
use App\Models\Topic;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        // create Mail -> Header, Body, Topic models
        Header::initHeader($mail);
        Topic::initTopic($mail);
        Body::initBody($mail);
    }
}
