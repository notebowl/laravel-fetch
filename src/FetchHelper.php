<?php

namespace NB\Utilities\Fetch;

use GuzzleHttp\Client as HttpClient;

class FetchHelper
{
    public function get($url, $headers = [])
    {
        $client = new HttpClient();

        return $client->get($url, $headers);
    }

    public function __call($method, $parameters)
    {
        return app('url')->$method(...$parameters);
    }
}
