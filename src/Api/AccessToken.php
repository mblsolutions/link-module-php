<?php

namespace MBLSolutions\LinkModule\Api;

class AccessToken
{
    private $expiresAt;

    public function __construct(
        public string $accessToken,

        public string $tokenType,

        public int $expiresIn,
    )
    {
        $this->expiresAt = time() + $expiresIn;
    }

    /***
     * Returns true if the token expires in the next $secondsNeeded seconds
     *
     * @param int $secondsNeeded
     * @return bool
     */
    public function isExpired(int $secondsNeeded = 60): bool
    {
        return (time() + $secondsNeeded) >= $this->expiresAt;
    }
}