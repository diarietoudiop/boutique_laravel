<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LocalStorageServiceFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'localStorageService';
    }
}
