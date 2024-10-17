<?php

namespace MBLSolutions\LinkModule\Auth;

use MBLSolutions\LinkModule\Exceptions\AuthenticationException;

class LinkModule
{
    private static string $baseUri = 'https://link-module.com';

    private static ?string $token = null;

    private static bool $verifySSL = true;

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

    public static function getToken(): string
    {
        if (empty(self::$token)) {
            throw new AuthenticationException();
        }

        return self::$token;
    }

    public static function setToken(string $token): void
    {
        self::$token = $token;
    }
}
