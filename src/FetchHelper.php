<?php

namespace NB\Utilities\Fetch;

class FetchHelper
{
    public function __call($method, $parameters)
    {
        return app('url')->$method(...$parameters);
    }
}
