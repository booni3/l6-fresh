<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tenancy\Hooks\Database\Events\Drivers\Configuring;

class ConfigureTenantDatabase
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
     * @param Configuring $event
     * @return void
     */
    public function handle(Configuring $event)
    {
        $event->useConnection('mysql', $event->configuration);
        $event->configuration['host'] = '%';
    }
}
