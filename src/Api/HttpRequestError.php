<?php

namespace MBLSolutions\LinkModule\Api;

use GuzzleHttp\Exception\ClientException;
use MBLSolutions\LinkModule\Exceptions\AuthenticationException;
use MBLSolutions\LinkModule\Exceptions\NotFoundException;
use MBLSolutions\LinkModule\Exceptions\PermissionDeniedException;
use MBLSolutions\LinkModule\Exceptions\ValidationException;

class HttpRequestError
{
    const HTTP_UNAUTHORIZED = 401;

    const HTTP_FORBIDDEN = 403;

    const HTTP_NOT_FOUND = 404;

    const HTTP_UNPROCESSABLE_ENTITY = 422;

    /**
     * Handle HTTP Client Request Error
     *
     * @param ClientException $exception
     * @return never
     */
    public static function handle(ClientException $exception): never
    {
        if ($exception->getCode() === self::HTTP_UNAUTHORIZED) {
            self::throwException(AuthenticationException::class, $exception);
        }

        if ($exception->getCode() === self::HTTP_FORBIDDEN) {
            self::throwException(PermissionDeniedException::class, $exception);
        }

        if ($exception->getCode() === self::HTTP_NOT_FOUND) {
            self::throwException(NotFoundException::class, $exception);
        }

        if ($exception->getCode() === self::HTTP_UNPROCESSABLE_ENTITY) {
            self::throwException(ValidationException::class, $exception);
        }

        throw $exception;
    }

    /**
     * Throw an Exception
     *
     * @param string $type
     * @param ClientException $exception
     * @return never
     */
    private static function throwException(string $type, ClientException $exception): never
    {
        $response = $exception->getResponse();

        if ($response) {
            $message = $response->getBody()->getContents();
        }

        throw new $type($message ?? 'Received an empty response', $exception->getCode(), $exception->getPrevious());
    }
}
