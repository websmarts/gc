<?php

namespace App\Utils;

use Illuminate\Support\Facades\Facade;

class HasherFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hasher';
    }
}