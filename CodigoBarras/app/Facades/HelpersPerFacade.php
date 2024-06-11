<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HelpersPerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'helperPer';
    }
}
