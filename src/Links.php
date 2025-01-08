<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\ApiResource;
use MBLSolutions\LinkModule\Auth\LinkModule;

class Links extends ApiResource
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
     * @param $reference
     * @param  $item
     * @param array|null $headers
     * @return array
     */
    public function show($reference, $item, array $headers = []): array
    {
        return $this->getApiRequestor()->getRequest("/api/{$this->endpoint}/show/{$reference}/{$item}/", [], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Redeem a single link
     *
     * @param $reference
     * @param  $item
     * @param array|null $headers
     * @return array
     */
    public function redeem($reference, $item, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/redeem/{$reference}/{$item}/", [], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Update a group of links
     *
     * @param $reference
     * @param  $item
     * @param array|null $headers
     * @return array
     */
    public function update($reference, $params, array $headers = []): array
    {
        return $this->getApiRequestor()->patchRequest("/api/{$this->endpoint}/update/{$reference}/", $params, array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    /**
     * Cancel a link
     *
     * @param string $id
     * @param array $headers
     */
    public function cancel(string $id, array $items, array $headers = []): array
    {
        return $this->getApiRequestor()->deleteRequest("/api/{$this->endpoint}/cancel/" . $id, [
            'items' => $items
        ], array_merge([
            'X-Max-Wait' => $this->maxWait
        ], $this->authorizationHeader(), $headers));
    }

    private function authorizationHeader(): array
    {
        $token = LinkModule::getToken();
        return ($token) ? ['Authorization' => $token] : [];
    }
}
