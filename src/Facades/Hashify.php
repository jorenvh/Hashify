<?php

namespace jorenvanhocht\Hashify\Facades;

use Illuminate\Support\Facades\Facade;

class Hashify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jorenvanhocht.hashify';
    }
}