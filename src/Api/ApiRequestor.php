<?php

namespace MBLSolutions\LinkModule\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use MBLSolutions\LinkModule\Auth\LinkModule;

class ApiRequestor
{
    public static ClientInterface $transport;

    /**
     * Create a new API Requestor Instance
     *
     * @param ClientInterface|null $transport
     */
    public function __construct(ClientInterface $transport)
    {
        self::$transport = $transport;
    }

    /**
     * Get the HTTP Client
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return self::$transport;
    }

    /**
     * Set the HTTP Client
     *
     * @param ClientInterface $guzzle
     */
    public static function setHttpClient(ClientInterface $guzzle)
    {
        self::$transport = $guzzle;
    }

    /**
     * Make a Get Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function getRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('get', $uri, [
            'headers' => $this->defaultHeaders($headers),
            'query' => $params,
        ]);
    }

    /**
     * Make a Post Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function postRequest(string $uri, array $params = [], array $headers = []): array
    {
        return $this->makeHttpRequest('post', $uri, [
            'headers' => $this->defaultHeaders($headers),
            'json' => $params,
        ]);
    }

    /**
     * Make a Patch Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function patchRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('patch', $uri, [
            'headers' => $this->defaultHeaders($headers),
            'json' => $params,
        ]);
    }

    /**
     * Make a Delete Request
     *
     * @param string $uri
     * @param array $params
     * @param array|null $headers
     * @return array
     * @throws mixed
     */
    public function deleteRequest(string $uri, array $params = [], array $headers = null): array
    {
        return $this->makeHttpRequest('delete', $uri, [
            'headers' => $this->defaultHeaders($headers),
            'query' => $params,
        ]);
    }

    /**
     * @param array $headers
     *
     * @return array
     */
    public function defaultHeaders(array $headers = []): array
    {
        return array_merge($headers, [
            'User-Agent' => LinkModule::getUserAgent(),
            'Accept'     => 'application/json',
        ]);
    }

    /**
     * Make a HTTP Request
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return void|array
     * @throws mixed
     */
    private function makeHttpRequest(string $method, string $uri, array $options = [])
    {
        try {
            $response = $this->getHttpClient()->request($method, $uri, $options);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            HttpRequestError::handle($exception);
        }
    }
}
