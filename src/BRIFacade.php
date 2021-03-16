<?php

namespace Aslam\BRI;

use Illuminate\Support\Facades\Facade;

class BRIFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BRI';
    }
}
