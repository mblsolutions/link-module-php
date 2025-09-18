<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\ApiResource;
use MBLSolutions\LinkModule\Auth\LinkModule;

class AssetMetadata extends ApiResource
{
    protected $endpoint = 'meta';

    public function updateForAsset(string $assetIdentifier, mixed $meta, array $headers = []): array
    {
        return $this->getApiRequestor()->postRequest("/api/{$this->endpoint}", [
            'asset_identifier' => $assetIdentifier,
            'meta' => $meta,
        ], [
            ...$this->authorizationHeader(),
            ...$headers
        ]);
    }

    private function authorizationHeader(): array
    {
        $token = LinkModule::getToken();
        return ($token) ? ['Authorization' => $token] : [];
    }
}
