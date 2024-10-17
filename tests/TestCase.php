<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MBLSolutions\LinkModule\Api\ApiRequestor;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Mock Expected HTTP Response
     *
     * @param array $response
     * @param int $code
     * @param array|null $headers
     */
    protected function mockExpectedHttpResponse(array $response, int $code = 200, array $headers = null)
    {
        $this->mockedResponse = new Response(
            $code,
            $headers ?? ['Content-Type' => 'application/json'],
            json_encode($response)
        );

        $mock = new MockHandler([
            $this->mockedResponse
        ]);

        $client = new Client([
            'handler' => HandlerStack::create($mock)
        ]);

        ApiRequestor::setHttpClient($client);
    }
}