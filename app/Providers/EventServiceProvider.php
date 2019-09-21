<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Tenancy\Affects\Connections\Events as Connection;
use Tenancy\Hooks\Database\Events\Drivers as Database;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        /**
         * Tenant database and connection configuration
         */
        Database\Configuring::class => [
            \App\Listeners\ConfigureTenantDatabase::class
        ],
        Connection\Resolving::class => [
            \App\Listeners\ResolveTenantConnection::class
        ],
        Connection\Drivers\Configuring::class => [
            \App\Listeners\ConfigureTenantConnection::class
        ],
        ConfigureMigrations::class => [
            \App\Listeners\ConfigureTenantMigration::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
