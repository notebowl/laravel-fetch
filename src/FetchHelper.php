<?php

namespace NB\Utilities\Fetch;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber as Retry;

class FetchHelper
{
    public function getRetry($url, $headers = [], $tries = 3, $status = null, $delay = null)
    {
        $status = $status ?: [500, 503];
        $retry = new Retry([
            'filter' => Retry::createChainFilter([
                Retry::createIdempotentFilter(),
                Retry::createCurlFilter(),
                Retry::createStatusFilter($status),
            ]),
            'max' => $tries,
            'delay' => function ($retries) use ($delay) {
                return $delay ?: (int) pow(2, $retries - 1);
            },
        ]);

        $client = new HttpClient();
        $client->getEmitter()->attach($retry);

        return $client->get($url, $headers);
    }

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
