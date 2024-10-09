<?php

namespace MBLSolutions\LinkModule\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use MBLSolutions\LinkModule\Auth\LinkModule;

abstract class ApiResource
{
    /** @var ApiRequestor $apiRequestor */
    private $apiRequestor;

    /**
     * SLD Module API Resource
     *
     * @param ClientInterface|null $client
     */
    public function __construct(ClientInterface $client = null)
    {
        if ($client === null) {
            $client = new Client([
                'base_uri' => LinkModule::getBaseUri(),
                'verify' => LinkModule::getVerifySSL(),
            ]);
        }

        $this->apiRequestor = new ApiRequestor($client);
    }

    /**
     * Get an API Requestor Instance
     *
     * @return ApiRequestor
     */
    public function getApiRequestor(): ApiRequestor
    {
        return $this->apiRequestor;
    }

    /**
     * Set a new instance of the API Requestor
     *
     * @param ApiRequestor $apiRequestor
     * @return ApiRequestor
     */
    public function setApiRequestor(ApiRequestor $apiRequestor): ApiRequestor
    {
        $this->apiRequestor = $apiRequestor;

        return $this->apiRequestor;
    }
}
