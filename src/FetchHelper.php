<?php

namespace NB\Utilities\Fetch;

use GuzzleHttp\Client as HttpClient;

class FetchHelper
{
    public function getResponseHeader($url, $header, $headers = [])
    {
        $response = $this->get($url, $headers);

        return $response->getHeader($header);
    }

    public function getBody($url, $headers = [])
    {
        $response = $this->get($url, $headers);

        return $response->getBody();
    }

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
