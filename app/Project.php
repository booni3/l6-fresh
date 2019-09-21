<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;
use Tenancy\Tenant\Events as TenancyEvents;

class Project extends Model implements Tenant, IdentifiesByHttp
{
    use AllowsTenantIdentification;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => TenancyEvents\Created::class,
        'updated' => TenancyEvents\Updated::class,
        'deleted' => TenancyEvents\Deleted::class,
    ];

    public function tenantIdentificationByHttp(Request $request): ?Tenant
    {
        if(app()->runningInConsole()){
            return null;
        }

        if(auth()->check() && $project = auth()->user()->current_project){
            return $this->newQuery()->findOrFail($project);
        }

        return null;
    }
}
