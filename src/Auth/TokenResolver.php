<?php

namespace MBLSolutions\LinkModule\Auth;

use MBLSolutions\LinkModule\Api\AccessToken;
use MBLSolutions\LinkModule\Api\OAuthResource;
use MBLSolutions\LinkModule\Auth\Contracts\TokenResolverInterface;

class TokenResolver implements TokenResolverInterface
{
    public function __construct(
        private string $tokenUri,

        private string $clientId,

        private string $clientSecret
    )
    {
    }

    public function resolveToken(): AccessToken
    {
        $resource = new OAuthResource(
            tokenUri: $this->tokenUri,
            clientId: $this->clientId,
            clientSecret: $this->clientSecret
        );

        return $resource->getToken();
    }
}