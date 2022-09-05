<?php

namespace App\Models;

use App\Services\PunkApi\PunkApiService;

class Beer extends PunkApiService
{
    protected $resource = 'beers';
}
