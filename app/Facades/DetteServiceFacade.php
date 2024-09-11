<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DetteServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'detteService';
    }
}
