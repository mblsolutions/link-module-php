<?php

namespace MBLSolutions\LinkModule\Api;

use MBLSolutions\LinkModule\Auth\LinkModule;

abstract class BaseResource extends ApiResource
{
    protected function authorizationHeader(): array
    {
        $token = LinkModule::getToken();
        return ($token) ? ['Authorization' => $token] : [];
    }
}
