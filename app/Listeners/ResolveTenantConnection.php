<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tenancy\Affects\Connections\Contracts\ProvidesConfiguration;
use Tenancy\Affects\Connections\Events\Drivers\Configuring;
use Tenancy\Affects\Connections\Events\Resolving;
use Tenancy\Concerns\DispatchesEvents;
use Tenancy\Identification\Contracts\Tenant;

class ResolveTenantConnection implements ProvidesConfiguration
{
    use DispatchesEvents;

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
     * @param Resolving $event
     * @return ResolveTenantConnection
     */
    public function handle(Resolving $event)
    {
        return $this;
    }

    public function configure(Tenant $tenant): array
    {
        $config = [];

        $this->events()->dispatch(new Configuring($tenant, $config, $this));

        return $config;
    }
}
