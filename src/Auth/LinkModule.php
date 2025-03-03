<?php

namespace MBLSolutions\LinkModule\Auth;

use MBLSolutions\LinkModule\Api\AccessToken;
use MBLSolutions\LinkModule\Auth\Contracts\TokenResolverInterface;
use MBLSolutions\LinkModule\Exceptions\AuthenticationException;

class LinkModule
{
    private static string $baseUri = 'https://link-module.com';

    private static ?AccessToken $token = null;

    private static bool $tokenEnabled = true;

    private static bool $verifySSL = true;

    private static ?TokenResolverInterface $tokenResolver = null;

    const AGENT = 'Link-Module-PHP';

    const VERSION = '1.0.0';

    /**
     * Override the default baseUri
     *
     * @param string $baseUri
     * @return void
     */
    public static function setBaseUri(string $baseUri = null): void
    {
        if ($baseUri) {
            self::$baseUri = $baseUri;
        }
    }

    /**
     * Get the SLD Module Base URI
     *
     * @return string
     */
    public static function getBaseUri(): string
    {
        return self::$baseUri;
    }

    /**
     * Set Verify SSL
     *
     * @param bool $verify
     * @return void
     */
    public static function setVerifySSL(bool $verify): void
    {
        self::$verifySSL = $verify;
    }

    /**
     * Get Verify SSL
     *
     * @return bool
     */
    public static function getVerifySSL(): bool
    {
        return self::$verifySSL;
    }

    public static function getUserAgent(): string
    {
        return self::AGENT . '/' . self::VERSION;
    }

    public static function getToken(): string | null
    {
        if (! self::$tokenEnabled) {
            return null;
        }

        if (! self::$token || self::$token->isExpired()) {
            if (! self::$tokenResolver) {
                throw new AuthenticationException('Authentication credentials not set');
            }

            self::$token = self::$tokenResolver->resolveToken();
        }

        return self::$token->tokenType . ' ' . self::$token->accessToken;
    }

    public static function setToken(AccessToken $token): void
    {
        self::$token = $token;
    }

    public static function enableToken(): void
    {
        self::$tokenEnabled = true;
    }

    public static function disableToken(): void
    {
        self::$tokenEnabled = false;
    }

    public static function getTokenResolver(): ?TokenResolverInterface
    {
        return self::$tokenResolver;
    }

    public static function setTokenResolver(?TokenResolverInterface $tokenResolver): void
    {
        self::$tokenResolver = $tokenResolver;
    }
}
