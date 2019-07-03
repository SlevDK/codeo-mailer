<?php

namespace App\Listeners;

use App\Models\CampaignAdditionalSettings;
use App\Models\CampaignFromEmailSettings;
use App\Models\CampaignProxySettings;
use App\Models\CampaignRandomizerSettings;
use App\Models\Maillist;

class InitCampaignParts
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
        $campaign = $event->campaign;

        // create campaign maillist, settings, etc
        Maillist::initMaillist($campaign);
        CampaignProxySettings::initProxySettings($campaign);
        CampaignFromEmailSettings::initFromEmailSettings($campaign);
        CampaignRandomizerSettings::initRandomizerSettings($campaign);
        CampaignAdditionalSettings::initAdditionalSettings($campaign);
    }
}
