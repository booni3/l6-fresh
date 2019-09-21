<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;

class ConfigureTenantMigration
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
     * @param ConfigureMigrations $event
     * @return void
     */
    public function handle(ConfigureMigrations $event)
    {
        $event->path(database_path('tenant'));
    }
}
