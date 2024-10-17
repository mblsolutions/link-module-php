<?php

namespace MBLSolutions\LinkModule\Exceptions;

use RuntimeException;
use Throwable;

class AuthenticationException extends RuntimeException
{
    public function __construct(string $message = "Missing access token.", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
