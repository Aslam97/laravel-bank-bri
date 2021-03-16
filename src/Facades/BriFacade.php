<?php

namespace Aslam\Bri\Facades;

use Illuminate\Support\Facades\Facade;

class BriFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BriAPI';
    }
}
