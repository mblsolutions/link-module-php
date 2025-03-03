<?php

namespace Tests\Unit\Auth;

use MBLSolutions\LinkModule\Auth\LinkModule;
use MBLSolutions\LinkModule\Auth\TokenResolver;
use MBLSolutions\LinkModule\Exceptions\AuthenticationException;
use Tests\TestCase;

class LinkModuleTest extends TestCase
{
    /** @test */
    public function throws_exception_if_no_token_set(): void
    {
        $this->expectException(AuthenticationException::class);

        LinkModule::getToken();
    }

    /** @test */
    public function authenticates_with_oauth_token(): void
    {
        $this->mockExpectedHttpResponse([
            'access_token' => 'test access token',
            'expires_in' => 3600,
            'token_type' => 'Bearer'
        ]);

        $tokenResolver = new TokenResolver(
            tokenUri: 'https://test.auth.eu-west-2.amazoncognito.com/oauth2/token',
            clientId: 'test',
            clientSecret: 'test'
        );

        LinkModule::setTokenResolver($tokenResolver);

        $token = $tokenResolver->resolveToken();

        LinkModule::setToken($token);

        $this->assertEquals('Bearer test access token', LinkModule::getToken());
    }

    /** @test */
    public function it_refreshes_expired_token(): void
    {
        $this->mockExpectedHttpResponse([
            'access_token' => 'expired access token',
            'expires_in' => 0,
            'token_type' => 'Bearer'
        ]);

        $tokenResolver = new TokenResolver(
            tokenUri: 'https://test.auth.eu-west-2.amazoncognito.com/oauth2/token',
            clientId: 'test',
            clientSecret: 'test'
        );

        LinkModule::setTokenResolver($tokenResolver);

        $token = $tokenResolver->resolveToken();

        LinkModule::setToken($token);

        $this->mockExpectedHttpResponse([
            'access_token' => 'refreshed access token',
            'expires_in' => 0,
            'token_type' => 'Bearer'
        ]);

        $this->assertEquals('Bearer refreshed access token', LinkModule::getToken());
    }
}