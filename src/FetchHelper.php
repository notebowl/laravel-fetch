<?php

namespace NB\Utilities\Fetch;

use GuzzleHttp\Client as HttpClient;

class FetchHelper
{
    protected function get($url, $headers = [])
    {
        $client = new HttpClient();
        $request = $client->get($url, $headers);

        return $request->send();
    }

    public function __call($method, $parameters)
    {
        return app('url')->$method(...$parameters);
    }
}
