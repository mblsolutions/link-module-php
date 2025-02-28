<?php

namespace Tests\Unit\Api;

use MBLSolutions\LinkModule\Api\AccessToken;
use Tests\TestCase;

class AccessTokenTest extends TestCase
{
    /** @test */
    public function it_returns_true_for_expired_token(): void
    {
        $token = new AccessToken(
            accessToken: __METHOD__ . '-test-accessToken',
            tokenType: 'Bearer',
            expiresIn: 0,
        );

        $this->assertTrue($token->isExpired());
    }

    /** @test */
    public function it_returns_false_for_valid_token(): void
    {
        $token = new AccessToken(
            accessToken: __METHOD__ . '-test-accessToken',
            tokenType: 'Bearer',
            expiresIn: 30,
        );

        $this->assertTrue($token->isExpired());
    }
}