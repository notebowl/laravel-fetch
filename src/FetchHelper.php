<?php

namespace NB\Utilities\Fetch;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Event\AbstractTransferEvent;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber as Retry;

class FetchHelper
{
    public function getRetry(string $url, array $headers = [], $tries = 3, array $status = null, $delay = null, array $customChain = null)
    {
        $status = $status ?: [500, 503];
        $retry = new Retry([
            'filter' => Retry::createChainFilter($customChain ?: [
                Retry::createIdempotentFilter(),
                Retry::createCurlFilter(),
                Retry::createStatusFilter($status),
            ]),
            'max' => $tries,
            'delay' => function ($retries, AbstractTransferEvent $e) use ($delay) {
                info('Delaying...');

                return $delay ?: (int) pow(2, $retries - 1);
            },
        ]);

        $client = new HttpClient();
        $client->getEmitter()->attach($retry);

        return $client->get($url, $headers);
    }

    public function getResponseHeader(string $url, string $header, array $headers = [])
    {
        $response = $this->get($url, $headers);

        return $response->getHeader($header);
    }

    public function getBody(string $url, array $headers = [])
    {
        $response = $this->get($url, $headers);

        return $response->getBody();
    }

    public function get(string $url, array $headers = [])
    {
        $client = new HttpClient();

        return $client->get($url, $headers);
    }

    public function __call($method, $parameters)
    {
        return app('url')->$method(...$parameters);
    }
}
