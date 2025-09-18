<?php

namespace MBLSolutions\LinkModule;

use MBLSolutions\LinkModule\Api\BaseResource;

class AssetMetadata extends BaseResource
{
    protected string $endpoint = 'metadata';

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
}
