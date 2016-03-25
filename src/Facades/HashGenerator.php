<?php

namespace JorenVanHocht\Hash\Facades;

use Illuminate\Support\Facades\Facade;

class HashGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jorenvanhocht.hash';
    }
}