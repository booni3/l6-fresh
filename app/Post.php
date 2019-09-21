<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class Post extends Model
{
    use OnTenant;
}
