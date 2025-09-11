<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\BaseResource;

class Links extends BaseResource
{
    public $maxWait = 10;

    protected $endpoint = 'link';

    /**
     * @param array $params
     * @param array|null $headers
     *
     * @return array
     */
    public function create(array $params, array $headers = []): array
    {
        return $this->getApiRequestor()->postRequest("/api/{$this->endpoint}/create/", $params, array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Show a single link
     *
     * @param string $reference
     * @param string $item
     * @param array|null $headers
     * @return array
     */
    public function show(string $reference, string $item, array $headers = []): array
    {
        return $this->getApiRequestor()->getRequest("/api/{$this->endpoint}/show/{$reference}/{$item}/", [], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Show a group link by reference
     *
     * @param string $reference
     * @param array $params
     * @param array|null $headers
     * @return array
     */
    public function showLinkGroup(string $reference, array $params, array $headers = []): array
    {
        return $this->getApiRequestor()->getRequest("/api/{$this->endpoint}/show-link-group/{$reference}/", $params, array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Redeem a single link
     *
     * @param string $reference
     * @param string $item
     * @param array|null $headers
     * @return array
     */
    public function redeem(string $reference, string $item, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/redeem/{$reference}/{$item}/", [], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Update a group of links
     *
     * @param string $reference
     * @param array $params
     * @param array|null $headers
     * @return array
     */
    public function update(string $reference, array $params, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/update/{$reference}/", $params, array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Cancel a link
     *
     * @param string $reference
     * @param array $items
     * @param array $headers
     * @return array
     */
    public function cancel(string $reference, array $items, array $headers = []): array
    {
        return $this->getApiRequestor()->deleteRequest("/api/{$this->endpoint}/cancel/" . $reference, [
            'items' => $items
        ], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Create a link and allocate a given serial and shortcode to it.
     *
     * @param array $params
     * @param array|null $headers
     * @return array
     */
    public function allocate(array $params, array $headers = []): array
    {
        return $this->getApiRequestor()->postRequest("/api/{$this->endpoint}/allocate/", $params, array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }
}
