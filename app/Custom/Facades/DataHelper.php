<?php

namespace App\Custom\Facades;

use Illuminate\Support\Facades\Facade;

class DataHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DataHelper';
    }
}