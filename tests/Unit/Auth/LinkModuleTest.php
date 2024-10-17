<?php

namespace Tests\Unit\Auth;

use MBLSolutions\LinkModule\Api\OAuthResource;
use MBLSolutions\LinkModule\Auth\LinkModule;
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
        $oauthClient = new OAuthResource(
            tokenUri: 'https://test.auth.eu-west-2.amazoncognito.com/oauth2/token',
            clientId: 'test',
            clientSecret: 'test'
        );

        $this->mockExpectedHttpResponse([
            'access_token' => 'test access token',
            'expires_in' => 3600,
            'token_type' => 'Bearer'
        ]);

        $token = $oauthClient->getToken();

        LinkModule::setToken($token->tokenType . ' ' . $token->accessToken);

        $this->assertEquals('Bearer test access token', LinkModule::getToken());
    }
}