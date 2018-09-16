<?php

namespace Newbiecoder\Uptube\Facades;

use Illuminate\Support\Facades\Facade;

class Uptube extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'uptube';
    }
}