<?php

namespace MBLSolutions\LinkModule\Auth\Contracts;

use MBLSolutions\LinkModule\Api\AccessToken;

interface TokenResolverInterface
{
    public function resolveToken(): AccessToken;
}