<?php

namespace MBLSolutions\LinkModule\Api;

class AccessToken
{
    public function __construct(
        public string $accessToken,

        public string $tokenType,

        public int $expiresIn,
    )
    {
    }
}