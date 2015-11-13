<?php

namespace NB\Utilities\Fetch;

use Illuminate\Support\Facades\Facade;

class FetchFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fetch';
    }
}
