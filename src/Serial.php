<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\BaseResource;

class Serial extends BaseResource
{
    public $maxWait = 10;

    protected $endpoint = 'serial';

    /**
     * Show a single serial
     *
     * @param string $serial
     * @param array|null $headers
     * @return array
     */
    public function show(string $serial, array $headers = []): array
    {
        return $this->getApiRequestor()->getRequest("/api/{$this->endpoint}/show/{$serial}/", [], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Redeem a single serial
     *
     * @param string $serial
     * @param array|null $headers
     * @return array
     */
    public function redeem(string $serial, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/redeem/", ['serial' => $serial], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Update a group of links by serials
     *
     * @param array $items
     * @param array|null $headers
     * @return array
     */
    public function update(array $items, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/update/", $items, array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Cancel links by serial
     *
     * @param array $items
     * @param array $headers
     * @return array
     */
    public function cancel(array $items, array $headers = []): array
    {
        return $this->getApiRequestor()->deleteRequest("/api/{$this->endpoint}/cancel/", [
            'items' => $items
        ], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }
}
