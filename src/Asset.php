<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\BaseResource;

class Asset extends BaseResource
{
    protected string $endpoint = 'asset';

    public function index(int $per_page = 100, int $page = 1, array $headers = []): array
    {
        return $this->getApiRequestor()->getRequest("/api/{$this->endpoint}", [
            'per_page' => $per_page,
            'page' => $page
        ], array_merge($this->authorizationHeader(), $headers));
    }
}
