<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\BaseResource;

class ShortCode extends BaseResource
{
    public $maxWait = 10;

    protected $endpoint = 'shortcode';

    /**
     * Show a single shortcode
     *
     * @param string $shortCode
     * @param array|null $headers
     * @return array
     */
    public function show(string $shortCode, array $headers = []): array
    {
        return $this->getApiRequestor()->postRequest("/api/{$this->endpoint}/show/", ['short_code' => $shortCode], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Redeem a single shortcode
     *
     * @param string $shortCode
     * @param array|null $headers
     * @return array
     */
    public function redeem(string $shortCode, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/redeem/", ['short_code' => $shortCode], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Update a group of links by shortcodes
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
     * Cancel links by shortcode
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
